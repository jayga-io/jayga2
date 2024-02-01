<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Http\Requests\StoreBookingRequest;
use App\Http\Requests\UpdateBookingRequest;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Listing;
use Illuminate\Http\Request;
use App\Models\TimeSlotShortstays;
use App\Models\UserNid;
use Illuminate\Support\Facades\Http;
use Storage;
class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::whereNotNull('name')->get();
        $listing = Listing::where('isApproved', true)->get();
        $times = TimeSlotShortstays::all();
        return view('admin.booking.add-booking')->with('user', $user)->with('listing', $listing)->with('times', $times);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        //input dynamic
        $short_stay = $request->input('short_stay');
        $lister_id = Listing::where('listing_id', $request->input('listing'))->get();
       
        if($short_stay == 0){
            
                Booking::create([
                    'user_id' => $request->input('user'),
                    'booking_order_name' => $request->input('booking_order_name'),
                
                    'lister_id' => $lister_id[0]->lister_id,
                    'listing_id' => $request->input('listing'),
                    'date_enter' => $request->input('date_enter'),
                    'date_exit' => $request->input('date_exit'),
                    'listing_type' => $request->input('listing_type'),
                    
                    
                    'short_stay_flag' => 0,
                    'all_day_flag' => 1,
                    'total_members' => $request->input('members'),
                    'email' => $request->input('email'),
                    'phone' => $request->input('phone'),
                    'messeges' => $request->input('messege'),
                ]);
            }else{
                Booking::create([
                    'user_id' => $request->input('user'),
                    'booking_order_name' => $request->input('booking_order_name'),
                    
                    'lister_id' => $lister_id[0]->lister_id,
                    'listing_id' => $request->input('listing'),
                    'date_enter' => $request->input('date_enter'),
                    'date_exit' => $request->input('date_enter'),
                    'listing_type' => $request->input('listing_type'),
                    'tier' => $request->input('tier'),
                    
                    'short_stay_flag' => 1,
                    'all_day_flag' => 0,
                    'total_members' => $request->input('members'),
                    'email' => $request->input('email'),
                    'phone' => $request->input('phone'),
                    'messeges' => $request->input('messege'),
                ]);
            }

            if($files = $request->file('guest_nid')){
                foreach($files as $file){
                    $path = $file->store('user_nids');
                    UserNid::create([
                         'user_id' => $request->input('user'),
                        'user_nid_filename' => $file->hashName(),
                        'user_nid_targetlocation' => $path,
                    ]);
                }
            }
        
        

        return redirect(route('addbooking'))->with('success', 'Booking submitted for approval');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store()
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $bookings = Booking::where('isApproved', false)->get();
        return view('admin.booking.pending-booking')->with('pending', $bookings);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, $id)
    {
        $booking = Booking::where('booking_id', $id)->get();
        $user_nids = UserNid::where('user_id', $booking[0]->user_id)->get();

        return view('admin.booking.view-booking')
        ->with('booking', $booking)->with('user', $user_nids);
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update()
    {
        //
    }

    public function approve(Request $request, $id){
        Booking::where('booking_id', $id)->update([
            'isApproved' => true
        ]);

        $booking_id = Booking::where('booking_id', $id)->get();
        $listing_name = Listing::where('listing_id', $booking_id[0]->listing_id)->get();

        $url = 'https://sysadmin.muthobarta.com/api/v1/send-sms';
            
        
        $phone = $booking_id[0]->phone;
        $data = [
            "sender_id" => "8809601010510",
            "receiver" => $phone,
            "message" =>  $booking_id[0]->booking_order_name . 'Your booking has been approved',
            "remove_duplicate" => true
        ];
        $response = Http::withHeaders([
            'Authorization' => 'Token d275d614a4ca92e21d2dea7a1e2bb81fbfac1eb0',
            
        ])->post($url, $data);

        

        $notifys = [
            'user_id' => $booking_id[0]->user_id,
            'lister_id' => $booking_id[0]->lister_id,
            'listing_id' => $booking_id[0]->listing_id,
            'booking_id' => $id,
            'type' => 'Booking',
            'messege' => 'Your Booking : '. $listing_name[0]->listing_title . 'has been approved'
           ];
    
           notify($notifys);

        return redirect(route('pendingbooking'))->with('success', 'Booking Approved');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
       $user = Booking::where('booking_id', $id)->get();
        $nids = UserNid::where('user_id', $user[0]->user_id)->get();
     

        foreach ($nids as $value) {
            Storage::delete($value->user_nid_targetlocation);
        }

        $booking_id = Booking::where('booking_id', $id)->get();
        $listing_name = Listing::where('listing_id', $booking_id[0]->listing_id)->get();

        $url = 'https://sysadmin.muthobarta.com/api/v1/send-sms';
            
        
        $phone = $booking_id[0]->phone;
        $data = [
            "sender_id" => "8809601010510",
            "receiver" => $phone,
            "message" => 'Your Booking: '. $$listing_name[0]->listing_title . 'has been declined',
            "remove_duplicate" => true
        ];
        
        send_sms($data);

        $notifys = [
            'user_id' => $booking_id[0]->user_id,
            'lister_id' => $booking_id[0]->lister_id,
            'listing_id' => $booking_id[0]->listing_id,
            'booking_id' => $id,
            'type' => 'Booking',
            'messege' => 'Your Booking : '. $listing_name[0]->listing_title . 'has been declined'
           ];
    
           notify($notifys);

        Booking::where('booking_id', $id)->delete();
        return redirect(route('pendingbooking'))->with('deleted', 'Booking Declined');
    }
}
