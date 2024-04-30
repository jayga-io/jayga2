<?php

namespace App\Http\Controllers\Host;
use App\Http\Controllers\Controller;
use App\Models\ListerDashboard;
use App\Http\Requests\StoreListerDashboardRequest;
use App\Http\Requests\UpdateListerDashboardRequest;
use App\Models\User;
use App\Models\Listing;
use App\Models\Booking;
use App\Models\ListingGuestAmenities;
use App\Models\ListingImages;
use App\Models\ListingRestrictions;
use App\Models\JaygaEarn;
use App\Models\ListingAvailable;
use App\Models\BookingHistory;
use App\Helpers\Sms;
use Illuminate\Http\Request;
use Storage;

class ListerDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $phone = $request->session()->get('phone');
        $id = $request->session()->get('user');
        $user = User::where('id', $id)->get();
        $listing = Listing::where('lister_id', $id)->get();
        
        return view('host.dashboard.dash')->with('phone', $phone)->with('uid', $id)->with('user', $user)->with('listing', $listing);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreListerDashboardRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(ListerDashboard $listerDashboard)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ListerDashboard $listerDashboard)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateListerDashboardRequest $request, ListerDashboard $listerDashboard)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ListerDashboard $listerDashboard)
    {
        //
    }


    //Bookings
    public function bookings(Request $request){
        $bookings = Booking::where('booking_status', 1)->where('isApproved', true)->where('isComplete', false)->where('payment_flag', true)->where('lister_id', $request->session()->get('user'))->with('listings')->with('short_stays')->get();
      // dd($bookings);
        $pending_bookings = Booking::where('booking_status', 0)->where('isApproved', false)->where('lister_id', $request->session()->get('user'))->get();
        return view('host.bookings.bookings')->with('bookings', $bookings)->with('pendings', $pending_bookings);
    }

    public function confirm(Request $request, $id){
        $booking_id = Booking::where('booking_id', $id)->get();
        $listing_name = Listing::where('listing_id', $booking_id[0]->listing_id)->get();
        Booking::where('booking_id', $id)->update([
            'booking_status' => 1,
            'isApproved' => true
        ]);

        

        $notifys = [
            'user_id' => $booking_id[0]->user_id,
            'lister_id' => $booking_id[0]->lister_id,
            'listing_id' => $booking_id[0]->listing_id,
            'booking_id' => $id,
            'type' => 'booking',
            'messege' => 'Your stay at : '. $listing_name[0]->listing_title . ' has been approved',
            'created_on' => date('Y-m-d H:i:s')
           ];
    
           notify($notifys);

           if($booking_id[0]->phone == null){

            $receipent = $booking_id[0]->email;
                $subject = 'Booking Request Approved';

                 Mail::plain(
                    view: 'mailTemplates.bookingApprove',
                    data: [
                        'user' => $booking_id[0]->booking_order_name,
                        'listing_title' => $listing_name[0]->listing_title,
                        'checkin' => $booking_id[0]->date_enter,
                        'checkout' => $booking_id[0]->date_exit,
                        
                    ],
                    callback: function (Message $message) use ($receipent, $subject) {
                        $message->to($receipent)->subject($subject);
                    }
                );

           }elseif($booking_id[0]->email == null){

            $data = [
                "sender_id" => "8809601010510",
                "receiver" => $booking_id[0]->phone,
                "message" => 'Dear user, your booking for : '. $listing_name[0]->listing_title . 'with jayga has been approved by the host',
                "remove_duplicate" => true
            ];
            send_sms($data);

           }else{
            //mail
            $receipent = $booking_id[0]->email;
                $subject = 'Booking Request Approved';

                 Mail::plain(
                    view: 'mailTemplates.bookingApprove',
                    data: [
                        'user' => $booking_id[0]->booking_order_name,
                        'listing_title' => $listing_name[0]->listing_title,
                        'checkin' => $booking_id[0]->date_enter,
                        'checkout' => $booking_id[0]->date_exit,
                        
                    ],
                    callback: function (Message $message) use ($receipent, $subject) {
                        $message->to($receipent)->subject($subject);
                    }
                );

                //messege
                $data = [
                    "sender_id" => "8809601010510",
                    "receiver" => $booking_id[0]->phone,
                    "message" => 'Dear user, your booking for : '. $listing_name[0]->listing_title . 'with jayga has been approved by the host',
                    "remove_duplicate" => true
                ];
                send_sms($data);
           }


           

        toastr()->addSuccess('Booking has been confirmed');
        return redirect()->back();
        
    }

    public function deny(Request $request, $id){
        $booking_id = Booking::where('booking_id', $id)->get();
        $listing_name = Listing::where('listing_id', $booking_id[0]->listing_id)->get();
        Booking::where('booking_id', $id)->update([
            'booking_status' => 2,
            'isApproved' => false
        ]);

        ListingAvailable::where('booking_id', $id)->delete();

        
        
        $notifys = [
            'user_id' => $booking_id[0]->user_id,
            'lister_id' => $booking_id[0]->lister_id,
            'listing_id' => $booking_id[0]->listing_id,
            'booking_id' => $id,
            'type' => 'Booking',
            'messege' => 'Your booking : '. $listing_name[0]->listing_title . ' has been declined',
            'created_on' => date('Y-m-d H:i:s')
           ];

           $books = Booking::where('booking_id', $id)->with('listings')->get();
           
           BookingHistory::create([
            'user_id' => $books[0]->user_id,
            'listing_id' => $books[0]->listing_id,
            'booking_id' => $books[0]->booking_id,
            'lister_id' => $books[0]->lister_id,
            'listing_title' => $books[0]->listings->listing_title,
            'listing_type' => $books[0]->listings->listing_type,
            'short_stay_flag' => $books[0]->short_stay_flag,
            'transaction_id' => $books[0]->transaction_id,
            'date_enter' => $books[0]->date_enter,
            'date_exit' => $books[0]->date_exit,
            'tier' => $books[0]->tier,
            'total_members' => $books[0]->total_members,
            'email' => $books[0]->email,
            'phone' => $books[0]->phone,
            'pay_amount' => $books[0]->pay_amount,
            'net_payable' => $books[0]->net_payable,
            'payment_flag' => $books[0]->payment_flag,
            'booking_status' => $books[0]->booking_status,
            'isApproved' => $books[0]->isApproved,
            'isComplete' => $books[0]->isComplete,
            'created_on' => date('Y-m-d H:i:s')
        ]);
        notify($notifys);

        if($booking_id[0]->phone == null){

            $receipent = $booking_id[0]->email;
                $subject = 'Booking Request Declined';

                 Mail::plain(
                    view: 'mailTemplates.bookingDecline',
                    data: [
                        'user' => $booking_id[0]->booking_order_name,
                        'listing_title' => $listing_name[0]->listing_title,
                        
                        
                    ],
                    callback: function (Message $message) use ($receipent, $subject) {
                        $message->to($receipent)->subject($subject);
                    }
                );



        }elseif($booking_id[0]->email == null){
            $data = [
                "sender_id" => "8809601010510",
                "receiver" => $booking_id[0]->phone,
                "message" => 'Dear user, your booking for : '. $listing_name[0]->listing_title . ' has been declined by the host',
                "remove_duplicate" => true
            ];
            send_sms($data);
        }else{
            //messege
            $data = [
                "sender_id" => "8809601010510",
                "receiver" => $phone,
                "message" => 'Dear user, your booking for : '. $listing_name[0]->listing_title . ' has been declined by the host',
                "remove_duplicate" => true
            ];
            send_sms($data);

            //mail
            $receipent = $booking_id[0]->email;
                $subject = 'Booking Request Declined';

                 Mail::plain(
                    view: 'mailTemplates.bookingDecline',
                    data: [
                        'user' => $booking_id[0]->booking_order_name,
                        'listing_title' => $listing_name[0]->listing_title,
                        
                        
                    ],
                    callback: function (Message $message) use ($receipent, $subject) {
                        $message->to($receipent)->subject($subject);
                    }
                );

        }

        Booking::where('booking_id', $id)->delete();
    
          
        
           
        toastr()->addWarning('Booking has been declined');
        return redirect()->back();
    }

    public function cancel(Request $request, $id){
        Booking::where('booking_id', $id)->update([
            'booking_status' => 2,
        ]);
        ListingAvailable::where('booking_id', $id)->delete();
        toastr()->addWarning('Booking has been canceled');
        return redirect()->back();
    }


    public function complete(Request $request, $id, $amount){
        $user = $request->session()->get('user');
        $paid_amount = $amount;
        $lister_fee = ($amount * 6.9) /100;
        $booking_fee = ($amount * 3) / 100;

        $lister_earn = $amount - $lister_fee;
        $jayga_earn = $amount - $booking_fee;

        $jayga_total = $lister_fee + $booking_fee ;

        Booking::where('booking_id', $id)->update([
            'isComplete' => true,
            'net_payable' => $lister_earn
        ]);
        $earning = ListerDashboard::where('lister_id', $user)->get();
        if(count($earning)>0){
           $update_earnings = $earning[0]->earnings + $lister_earn;
           $total_earn = $earning[0]->total_earnings + $lister_earn;
            ListerDashboard::where('lister_id', $user)->update([
                'total_earnings' => $total_earn,
                'earnings' => $update_earnings
            ]);
        }else{
            ListerDashboard::create([
                'lister_id' => $user,
                'total_earnings' => $lister_earn,
                'earnings' => $lister_earn
            ]);
            
        }

        $books = Booking::where('booking_id', $id)->with('listings')->get();

        JaygaEarn::create([
            'invoice' => $books[0]->invoice_number,
            'listing_id' => $books[0]->listing_id,
            'booking_id' => $id,
            'listing_fee' => $lister_fee,
            'booking_fee' => $booking_fee,
            'total' => $jayga_total
        ]);

        BookingHistory::create([
            'user_id' => $user,
            'listing_id' => $books[0]->listing_id,
            'booking_id' => $books[0]->booking_id,
            'lister_id' => $books[0]->lister_id,
            'listing_title' => $books[0]->listings->listing_title,
            'listing_type' => $books[0]->listings->listing_type,
            'short_stay_flag' => $books[0]->short_stay_flag,
            'transaction_id' => $books[0]->transaction_id,
            'date_enter' => $books[0]->date_enter,
            'date_exit' => $books[0]->date_exit,
            'tier' => $books[0]->tier,
            'total_members' => $books[0]->total_members,
            'email' => $books[0]->email,
            'phone' => $books[0]->phone,
            'pay_amount' => $books[0]->pay_amount,
            'net_payable' => $books[0]->net_payable,
            'payment_flag' => $books[0]->payment_flag,
            'booking_status' => $books[0]->booking_status,
            'isApproved' => $books[0]->isApproved,
            'isComplete' => $books[0]->isComplete,
            'created_on' => date('Y-m-d H:i:s')
        ]);

        Booking::where('booking_id', $id)->delete();
        ListingAvailable::where('booking_id', $id)->delete();
        
        toastr()->addSuccess('Booking has been completed');
        return redirect()->back();
    }



    //Listings
    public function listings(Request $request){
        $user_id = $request->session()->get('user');
        $listings = Listing::where('lister_id', $user_id)->get();
        $inactive_listings = Listing::where('lister_id', $user_id)->where('isActive', false)->get();
        return view('host.listings.listing')->with('listings', $listings)->with('inactives', $inactive_listings);
    }

    public function edit_listing(Request $request, $id){
        $listing = Listing::where('listing_id', $id)->get();
        $amenities = ListingGuestAmenities::where('listing_id', $id)->get();
        $restrictions = ListingRestrictions::where('listing_id', $id)->get();
        $listing_images = ListingImages::where('listing_id', $id)->get();
        return view('host.listings.single-listing')->with('listing', $listing)->with('amenities', $amenities)->with('restrictions', $restrictions)->with('images', $listing_images);
    }



    public function update_listing(Request $request){
       // dd($request->all());
        Listing::where('listing_id', $request->input('listing_id'))->update([
            
            'listing_title' => $request->input('listing_title'),
            'listing_description' => $request->input('listing_description'),
            'full_day_price_set_by_user' => $request->input('price'),
            'listing_address' => $request->input('listing_address'),
            'isActive' => $request->input('active'),
            'guest_num' => $request->input('guest_num'),
            'bed_num' => $request->input('bed_num'),
            'bathroom_num' => $request->input('bathroom_num'),
            'listing_type' => $request->input('listing_type'),
            'video_link' => $request->input('video_link'),
        ]);

       

        ListingGuestAmenities::where('listing_id', $request->input('listing_id'))->update([
            
            'wifi' => $request->input('wifi'),
            'tv' => $request->input('tv'),
            'kitchen' => $request->input('kitchen'),
            'washing_machine' => $request->input('washing_machine'),
            'free_parking' => $request->input('free_parking'),
            'breakfast_included' => $request->input('breakfast_included'),
            'air_condition' => $request->input('air_condition'),
            'dedicated_workspace' => $request->input('dedicated_workspace'),
            
            'gym' => $request->input('gym'),
            'beach_lake_access' => $request->input('beach_lake_access'),
            
            'fire_extinguish' => $request->input('fire_extinguish'),
            'cctv' => $request->input('cctv'),
        ]);

        ListingRestrictions::where('listing_id', $request->input('listing_id'))->update([
            
            'indoor_smoking' => $request->input('indoor_smoking'),
            'party' => $request->input('party'),
            'pets' => $request->input('pets'),
            'late_night_entry' => $request->input('late_night_entry'),
            'unknown_guest_entry' => $request->input('unknown_guest_entry'),
            
            
        ]);

        if($filez = $request->file('lsimages')){
            foreach ($filez as $ls) {
                $path = $ls->store('listings');
                ListingImages::create([
                    'listing_id' => $request->input('listing_id'),
                    'lister_id' => $request->session()->get('user'),
                    'listing_filename' => $ls->hashName(),
                    'listing_targetlocation' => $path,
                ]);
            }
        }

        if($files = $request->file('images')){
            $imges = ListingImages::where('listing_id', $request->input('listing_id'))->get();
            if(count($imges)>0){
                foreach ($imges as $value) {
                    Storage::delete($value->listing_targetlocation);
                }
                
                ListingImages::where('listing_id', $request->input('listing_id'))->delete();
            }

            foreach ($files as $file) {
                $path = $file->store('listings');
                ListingImages::create([
                    'listing_id' => $request->input('listing_id'),
                    'lister_id' => $request->session()->get('user'),
                    'listing_filename' => $file->hashName(),
                    'listing_targetlocation' => $path,
                ]);
            }
        }
        toastr()->addSuccess('Listing updated');
        return redirect()->back();
    }

    public function delete(Request $request, $id){
       $ls = ListingImages::where('listing_id', $id)->get();
       if(count($ls)>0){
        foreach ($ls as $item) {
            Storage::delete($item->listing_targetlocation);
        }
       }
       Listing::where('listing_id', $id)->delete();
       toastr()->addWarning('Listing Deleted');
       return redirect()->back();
    }

    public function remove_image(Request $request, $id){
       $file = ListingImages::where('listing_img_id', $id)->get();
        Storage::delete($file[0]->listing_targetlocation);
        ListingImages::where('listing_img_id', $id)->delete();
        toastr()->addSuccess('Listing image removed');
        return redirect()->back();
    }
    
}
