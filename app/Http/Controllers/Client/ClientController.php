<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Listing;
use App\Models\Booking;
use App\Models\User;
use App\Models\ListingAvailable;
use App\Models\ListingGuestAmenities;
use App\Models\ListingRestrictions;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $listings = Listing::with('images')->with('reviews')->take(8)->get();
        
       // dd($listings[0]->reviews[0]->avg_rating);
       return view('client.home.home')->with('listings', $listings);
    
    }

    /**
     * Show the form for creating a new resource.
     */
    public function search(Request $request)
    {
        dd($request->all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
      // dd($request->all());
        
        $shortStay = $request->input('short_stay');
        $slot  = $request->input('short_stay_slot');
        $invoice_number = Str::random(8);
        
        $pay = Http::withHeaders([
            'merchantId' => '4101704973087',
            'password' => 'J@yGA3087',
        ])->post('https://api.paystation.com.bd/grant-token');

       // dd(json_decode($pay));

       $payResponse = json_decode($pay);

       
       
        if($payResponse->status == 'success'){
            $url = 'https://api.paystation.com.bd/create-payment';
            $data = [
                'invoice_number' => $invoice_number,
                'currency' => 'BDT',
                'payment_amount' => $request->input('total_paid'),
                'cust_name' => $request->input('booking_order_name'),
                'cust_phone' => $request->input('phone'),
                'cust_email' => $request->input('email'),
                'callback_url' => env('APP_URL'). '/client/update/booking/' . $invoice_number,

            ];
            $make_payment = Http::withHeaders([
                'token' => $payResponse->token
            ])->post($url, $data);
            $make_payment_response = json_decode($make_payment);

            if($make_payment_response->status == 'success'){

                if($shortStay){
                    Booking::create([
                     'user_id' => $request->input('user_id'),
                     'booking_order_name' => $request->input('booking_order_name'),
                     'listing_id' => $request->input('listing_id'),
                     'lister_id' => $request->input('lister_id'),
                     'net_payable' => $request->input('net_payable'),
                     'pay_amount' => $request->input('total_paid'),
                     'total_members' => $request->input('guest_num'),
                     'date_enter' => $request->input('checkin'),
                     'date_exit' => $request->input('checkout'),
                     'short_stay_flag' => $shortStay,
                     'all_day_flag' => 0,
                     'tier' => $slot,
                     'email' => $request->input('email'),
                     'phone' => $request->input('phone'),
                     'invoice_number' => $invoice_number,
                     'platform_type' => 'web',
                 ]); 
                    // return redirect()->back()->with('success', 'Booking placed successfully');
                 }else{
                     Booking::create([
                         'user_id' => $request->input('user_id'),
                         'booking_order_name' => $request->input('booking_order_name'),
                         'listing_id' => $request->input('listing_id'),
                         'lister_id' => $request->input('lister_id'),
                         'net_payable' => $request->input('net_payable'),
                         'pay_amount' => $request->input('total_paid'),
                         'total_members' => $request->input('guest_num'),
                         'date_enter' => $request->input('checkin'),
                         'date_exit' => $request->input('checkout'),
                         'short_stay_flag' => 0,
                         'all_day_flag' => 1,
                         'tier' => 0,
                         'email' => $request->input('email'),
                        'phone' => $request->input('phone'),
                        'invoice_number' => $invoice_number,
                        'platform_type' => 'web',
                     ]);
                    // return redirect()->back()->with('success', 'Booking placed successfully');
                 }
                
                return redirect($make_payment_response->payment_url);
            }else{
                return redirect()->back()->with('errors', 'something went wrong with payment. Try again');
            }
        }else{
            return redirect()->back()->with('errors', 'Unable to generate payment token. Try again');
        }

       
        

        
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, $id)
    {
        $listing = Listing::where('listing_id', $id)->with('images')->with('reviews')->with('booking')->with('available_dates')->with('host.avatars')->get();
        $bookings = User::where('id', $request->session()->get('user'))->with('bookings')->get();
       // dd($bookings);
            $amenitiesColumnsWithValueOne = [];
            $tableName = (new ListingGuestAmenities)->getTable();

            // Get all column names from the table
            $columnNames = Schema::getColumnListing($tableName);

            // Loop through each column and check if the value is 1 in any record
            foreach ($columnNames as $columnName) {
                $count = ListingGuestAmenities::where($columnName, 1)->where('listing_id', $listing[0]->listing_id)->count();
                if ($count > 0) {
                    $amenitiesColumnsWithValueOne[] = $columnName;
                }
            }

           $restrictionColumnsWithValueOne = [];

           $tableName = (new ListingRestrictions)->getTable();

           // Get all column names from the table
           $columnNames = Schema::getColumnListing($tableName);

           // Loop through each column and check if the value is 1 in any record
           foreach ($columnNames as $columnName) {
               $count = ListingRestrictions::where($columnName, 1)->where('listing_id', $listing[0]->listing_id)->count();
               if ($count > 0) {
                   $restrictionColumnsWithValueOne[] = $columnName;
               }
           }

          // dd($listing);
          $disable_dates = ListingAvailable::where('listing_id', $id)->get();


         
        return view('client.home.single-listing')->with('listing', $listing)->with('amenities', $amenitiesColumnsWithValueOne)->with('restrictions', $restrictionColumnsWithValueOne)->with('bookings', $bookings)->with('disable_dates', $disable_dates);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $listing_id = Booking::where('invoice_number', $id)->get();
       if($request->query('trx_id') != null){
            Booking::where('invoice_number', $id)->update([
                'payment_flag' => true,
                'transaction_id' => $request->query('trx_id'),
            ]);

            

            return redirect('/client/single-listing/'.$listing_id[0]->listing_id)->with('success', 'Booking has been placed');
       }else{
            

            return redirect('/client/single-listing/'.$listing_id[0]->listing_id)->with('error', 'Payment not completed');
       }
       
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


}
