<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Listing;
use App\Models\Booking;
use App\Models\User;
use App\Models\Reviews;
use App\Models\FavListing;
use App\Models\ListingAvailable;
use App\Models\ListingGuestAmenities;
use App\Models\ListingRestrictions;
use App\Models\TimeSlotShortstays;
use App\Models\Notification;
use App\Models\BookingHistory;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $listings = Listing::where('isApproved', true)->where('isActive', true)->with('images')->with('reviews')->take(8)->get();

        $notifs = Notification::where('user_id', $request->session()->get('user'))->where('type', 'booking')->count();

       // dd($listings);
       // dd($listings[0]->reviews[0]->avg_rating);
       return view('client.home.home')->with('listings', $listings)->with('notifcount', $notifs);
    
    }

    /**
     * Show the form for creating a new resource.
     */
    public function search(Request $request)
    {
       // dd($request->all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       // dd($request->all());
        $daterange = $request->input('daterange');
        $dates = explode("-", $daterange);
       //dd($dates[1]);
       // dd($request->all());
      // dd($dates[0] === $dates[1]);

     

     // dd($checkin === $checkout);
      
          
        $shortStay = $request->input('short_stay');
        $slot  = $request->input('short_stay_slot');
        $invoice_number = Str::random(8);

        if($request->session()->get('user_name') == null && $request->session()->get('user_email') == null && $request->session()->get('phone') == null){
            return redirect(route('userprofile'))->with('messege', 'Please complete your profile. Name, Email, Phone & NID fields are mandatory');
        }else{

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
    
                    if(isset($shortStay) && isset($slot)){
                        $date1 = strtotime($dates[0]);
                       // $date2 = strtotime($dates[1]);
                  
                        $checkin = date('Y-m-d', $date1);
                      //  $checkout = date('m-d-Y', $date2);
                        Booking::create([
                         'user_id' => $request->input('user_id'),
                         'booking_order_name' => $request->input('booking_order_name'),
                         'listing_id' => $request->input('listing_id'),
                         'lister_id' => $request->input('lister_id'),
                         'net_payable' => $request->input('net_payable'),
                         'pay_amount' => $request->input('total_paid'),
                         'total_members' => $request->input('guest_num'),
                         'date_enter' => $checkin,
                         'date_exit' => $checkin,
                         'days_stayed' => $request->input('days_stay'),
                         'short_stay_flag' => $shortStay,
                         'all_day_flag' => 0,
                         'tier' => $slot,
                         'email' => $request->input('email'),
                         'phone' => $request->input('phone'),
                         'invoice_number' => $invoice_number,
                         'platform_type' => 'web',
                     ]); 

                     $booked = Booking::where('invoice_number', $invoice_number)->get();
                     ListingAvailable::create([
                        'lister_id' => $request->input('lister_id'),
                        'listing_id' => $request->input('listing_id'),
                        'booking_id' => $booked[0]->booking_id,
                        'dates' => $checkin
    
                    ]);

                        // return redirect()->back()->with('success', 'Booking placed successfully');
                     }else{
                        $date1 = strtotime($dates[0]);
                        $date2 = strtotime($dates[1]);
                  
                        $checkin = date('Y-m-d', $date1);
                        $checkout = date('Y-m-d', $date2);


                        

                       $bet1 =  Carbon::parse($checkin);
                         $bet2 =  Carbon::parse($checkout);

                        $periods = CarbonPeriod::create($bet1, $bet2);

                      //  dd($periods);

                        if($checkin == $checkout){
                            return redirect()->back()->with('error', 'Invalid date selection');
                        }else{
                            Booking::create([
                             'user_id' => $request->input('user_id'),
                             'booking_order_name' => $request->input('booking_order_name'),
                             'listing_id' => $request->input('listing_id'),
                             'lister_id' => $request->input('lister_id'),
                             'net_payable' => $request->input('net_payable'),
                             'pay_amount' => $request->input('total_paid'),
                             'total_members' => $request->input('guest_num'),
                             'date_enter' => $checkin,
                             'date_exit' => $checkout,
                             'days_stayed' => $request->input('days_stay'),
                             'short_stay_flag' => 0,
                             'all_day_flag' => 1,
                             'tier' => 0,
                             'email' => $request->input('email'),
                            'phone' => $request->input('phone'),
                            'invoice_number' => $invoice_number,
                            'platform_type' => 'web',
                         ]);

                        // Array to store the dates between $start and $end
                        $intrvl = [];

                        $booked = Booking::where('invoice_number', $invoice_number)->get();

                        // Iterate over each date in the period and add it to the $dateRange array
                        foreach ($periods as $d) {
                            $intrvl[] = $d->toDateString();
                        }
                            foreach ($intrvl as $key => $value) {
                                ListingAvailable::create([
                                    'lister_id' => $request->input('lister_id'),
                                    'listing_id' => $request->input('listing_id'),
                                    'booking_id' => $booked[0]->booking_id,
                                    'dates' => $value
                
                                ]);
                            }
                        }
                         
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
        
        
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, $id)
    {
        $listing = Listing::where('listing_id', $id)->where('isApproved', true)->where('isActive', true)->with('images')->with('reviews')->with('booking')->with('disable_dates')->with('host.avatars')->get();
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
         // $timeSlots = (new TimeSlotShortstays)->getTable();

          $timeSlots = TimeSlotShortstays::all();

          //dd($timeSlots);
         // $disable_dates = ListingAvailable::where('listing_id', $id)->get();
         $dis_dates = Booking::where('listing_id', $id)->get();
        $dates = [];
        
        foreach ($dis_dates as $value) {
            array_push($dates, [
                'checkin' => $value->date_enter,
                'checkout' => $value->date_exit
            ]);
           
        }

        $newDates = json_encode($dates);
        $midDates = json_decode($newDates);
        $decodDates = collect($midDates);
       // dd($decodDates[0]->checkin);

           $reviews = Reviews::where('listing_id', $id)->with('user')->with('user_avatar')->get();

           $fivestarcount = Reviews::where('listing_id', $id)->where('stars', 5)->count();
           $fourstarcount = Reviews::where('listing_id', $id)->where('stars', 4)->count();
           $threestarcount = Reviews::where('listing_id', $id)->where('stars', 3)->count();
           $twostarcount = Reviews::where('listing_id', $id)->where('stars', 2)->count();
           $onestarcount = Reviews::where('listing_id', $id)->where('stars', 1)->count();
          //dd($reviews);
         
           $favcheck = FavListing::where('user_id', $request->session()->get('user'))->where('listing_id', $id)->get();


        return view('client.home.single-listing')->with('listing', $listing)->with('amenities', $amenitiesColumnsWithValueOne)->with('restrictions', $restrictionColumnsWithValueOne)->with('slots', $timeSlots)->with('disable_dates', $decodDates)->with('user', $reviews)
        ->with('fav', $favcheck)
        ->with('five', $fivestarcount)
        ->with('four', $fourstarcount)
        ->with('three', $threestarcount)
        ->with('two', $twostarcount)
        ->with('one', $onestarcount);
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
        $listing_id = Booking::where('invoice_number', $id)->with('listings')->get();
        $user = $request->session()->get('user');
       if($request->query('trx_id') != null){
            Booking::where('invoice_number', $id)->update([
                'payment_flag' => true,
                'transaction_id' => $request->query('trx_id'),
            ]);

            

            $listing = Listing::where('listing_id', $listing_id[0]->listing_id)->get();

            Notification::create([
                'user_id' => $user,
                'lister_id' => $listing_id[0]->lister_id,
                'listing_id' => $listing_id[0]->listing_id,
                'booking_id' => $listing_id[0]->booking_id,
                'type' => 'booking',
                'messege' => 'Your Booking at : '.$listing[0]->listing_title. ' has been placed',

            ]);
            $phone = User::where('id', $listing_id[0]->lister_id)->get();
            $data = [
                "sender_id" => "8809601010510",
                "receiver" => $phone[0]->phone,
                "message" => 'Your listing : '. $listing[0]->listing_title . ' has a new booking request',
                "remove_duplicate" => true
            ];

            send_sms($data);

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


    public function apply_filter(Request $request){
       // dd($request->query('allow_short_stay'));
      // $filter = Listing::where('isApproved', true)->where('isActive', true)
                    //    ->orWhere('listing_type', $request->input('inlineRadioOptions'))
                   //     ->orWhere('full_day_price_set_by_user', '>', $request->input('min_price'))
                    //    ->orWhere('full_day_price_set_by_user', '<', $request->input('max_price'))
                    //    ->orWhere('guest_num', $request->input('guests'))
                    //    ->orWhere('bed_num', $request->input('bedrooms'))
                    //    ->orWhere('bathroom_num', $request->input('bathrooms'))
                    //    ->orWhere('allow_short_stay', $request->input('shortstay'))
                    //    ->with('images')
                    //    ->get();

                   

                    $filter = QueryBuilder::for(Listing::class)->where('isApproved', true)->where('isActive', true)->where('listing_type', $request->query('listing_type'))->where('full_day_price_set_by_user', '>=', $request->query('min_price'))->where('full_day_price_set_by_user', '<=', $request->query('max_price'))->where('allow_short_stay', $request->query('allow_short_stay'))->allowedFilters(['guest_num', 'bed_num', 'bathroom_num'])->with('images')->with('amenities')->with('restrictions')->with('reviews')->get();
        
            // dd($filter);
        return view('client.search.searchResults')->with('listings', $filter);
                        
    }

    public function latest(Request $request){
        $listings = Listing::where('isApproved', true)->where('isActive', true)->orderBy('created_at', 'DESC')->with('images')->with('reviews')->get();
       // dd($listings);
       return view('client.search.searchResults')->with('listings', $listings)->with('latest', 'latest');
    }



    public function top(Request $request){
        $listings = Listing::where('isApproved', true)->where('isActive', true)->with('images')->with('reviews')->withCount('reviews')->orderBy('reviews_count', 'DESC')->take(25)->get();
       // dd($listings);

       return view('client.search.searchResults')->with('listings', $listings)->with('top', 'top');
    }


    public function my_bookings(Request $request){
       
       $user = $request->session()->get('user');
       $books = Booking::where('user_id', $user)->with('listings')->with('listing_images')->orderBy('created_at', 'DESC')->get();
       $past_bookings = BookingHistory::where('user_id', $user)->with('listings')->with('listing_images')->orderBy('created_at', 'DESC')->get();
       // dd($books);
       return view('client.bookings.mybooking')->with('listings', $books)->with('past_bookings', $past_bookings);
    }

    public function all_listing(Request $request){
        $ls = Listing::where('isApproved', true)->where('isActive', true)->paginate(40);
        return view('client.search.all-listings')->with('listings', $ls);
    }


}
