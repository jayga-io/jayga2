<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Http\Requests\StoreBookingRequest;
use App\Http\Requests\UpdateBookingRequest;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Listing;
use Illuminate\Http\Request;
use App\Models\TimeSlotShortstays;
use App\Models\UserNid;

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
       
        if($short_stay === null){
            $date_enter = Carbon::parse($request->input('date_enter'));
            $date_exit = Carbon::parse($request->input('date_exit'));
            $days_stayed = $date_exit->diffInDays($date_enter);
                Booking::create([
                    'user_id' => $request->input('user'),
                    'booking_order_name' => $request->input('booking_order_name'),
                    
                    'lister_id' => $lister_id[0]->lister_id,
                    'listing_id' => $request->input('listing'),
                    'date_enter' => $request->input('date_enter'),
                    'date_exit' => $request->input('date_exit'),
                    'listing_type' => $request->input('listing_type'),
                    
                    'days_stayed' => $days_stayed,
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
                    'days_stayed' => 1,
                    'short_stay_flag' => 1,
                    'all_day_flag' => 0,
                    'total_members' => $request->input('members'),
                    'email' => $request->input('email'),
                    'phone' => $request->input('phone'),
                    'messeges' => $request->input('messege'),
                ]);
            }

        $files = $request->input('guest_nid');
        foreach($files as $file){
            $path = $file->store('user_nids');
            UserNid::create([
                'user_id' => $request->input('user'),
                'user_nid_filename' => $f->hashName(),
                'user_nid_targetlocation' => $path,
            ]);
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update()
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
        //
    }
}
