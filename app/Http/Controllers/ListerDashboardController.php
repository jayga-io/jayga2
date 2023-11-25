<?php

namespace App\Http\Controllers;

use App\Models\ListerDashboard;
use App\Http\Requests\StoreListerDashboardRequest;
use App\Http\Requests\UpdateListerDashboardRequest;
use App\Models\User;
use App\Models\Listing;
use App\Models\Booking;
use App\Models\ListingGuestAmenities;
use App\Models\ListingRestrictions;
use Illuminate\Http\Request;

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
        $bookings = Booking::where('isApproved', true)->where('booking_status', 1)->where('lister_id', $request->session()->get('user'))->get();
       
        $pending_bookings = Booking::where('booking_status', 0)->where('lister_id', $request->session()->get('user'))->get();
        return view('host.bookings.bookings')->with('bookings', $bookings)->with('pendings', $pending_bookings);
    }

    public function confirm(Request $request, $id){
        Booking::where('booking_id', $id)->update([
            'booking_status' => 1,
            'isApproved' => true
        ]);
        toastr()->addSuccess('Booking has been confirmed');
        return redirect()->back();
        
    }

    public function deny(Request $request, $id){
        Booking::where('booking_id', $id)->update([
            'booking_status' => 2,
            'isApproved' => true
        ]);
        toastr()->addWarning('Booking has been declined');
        return redirect()->back();
    }

    public function cancel(Request $request, $id){
        Booking::where('booking_id', $id)->update([
            'booking_status' => 2,
        ]);
        toastr()->addWarning('Booking has been canceled');
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
        return view('host.listings.single-listing')->with('listing', $listing)->with('amenities', $amenities)->with('restrictions', $restrictions);
    }

    public function update_listing(Request $request){
        Listing::where('listing_id', $request->input('listing_id'))->update([
            'lister_id' => $request->input('user_id'),
            'lister_name' => $request->input('lister_name'),
            'guest_num' => $request->input('guest_num'),
            'bed_num' => $request->input('bed_num'),
            'bathroom_num' => $request->input('bathroom_num'),
            'listing_title' => $request->input('listing_title'),
            'listing_description' => $request->input('listing_description'),
            'full_day_price_set_by_user' => $request->input('full_day_price_set_by_user'),
            'listing_address' => $request->input('listing_address'),
            'zip_code' => $request->input('zip_code'),
            'district' => $request->input('district'),
            'town' => $request->input('town'),
            'allow_short_stay' => $request->input('allow_short_stay'),
            'describe_peaceful' => $request->input('describe_peaceful'),
            'describe_unique' => $request->input('describe_unique'),
            'describe_familyfriendly' => $request->input('describe_familyfriendly'),
            'describe_stylish' => $request->input('describe_stylish'),
            'describe_central' => $request->input('describe_central'),
            'describe_spacious' => $request->input('describe_spacious'),
            'lat' => $request->input('lati'),
            'long' => $request->input('longi'),
            'listing_type' => $request->input('listing_type'),
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
            'pool' => $request->input('pool'),
            'hot_tub' => $request->input('hot_tub'),
            'patio' => $request->input('patio'),
            'bbq_grill' => $request->input('bbq_grill'),
            'outdooring' => $request->input('outdooring'),
            'fire_pit' => $request->input('fire_pit'),
            'gym' => $request->input('gym'),
            'beach_lake_access' => $request->input('beach_lake_access'),
            'smoke_alarm' => $request->input('smoke_alarm'),
            'first_aid' => $request->input('first_aid'),
            'fire_extinguish' => $request->input('fire_extinguish'),
            'cctv' => $request->input('cctv'),
        ]);

        ListingRestrictions::where('listing_id', $request->input('listing_id'))->update([
            
            'indoor_smoking' => $request->input('indoor_smoking'),
            'party' => $request->input('party'),
            'pets' => $request->input('pets'),
            'late_night_entry' => $request->input('late_night_entry'),
            'unknown_guest_entry' => $request->input('unknown_guest_entry'),
            'specific_requirement' => $request->input('specific_requirement'),
            
        ]);
        toastr()->addSuccess('Listing updated');
        return redirect()->back();
    }

    
}
