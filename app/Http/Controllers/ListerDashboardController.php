<?php

namespace App\Http\Controllers;

use App\Models\ListerDashboard;
use App\Http\Requests\StoreListerDashboardRequest;
use App\Http\Requests\UpdateListerDashboardRequest;
use App\Models\User;
use App\Models\Listing;
use App\Models\Booking;
use App\Models\ListingGuestAmenities;
use App\Models\ListingImages;
use App\Models\ListingRestrictions;
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
            
            'listing_title' => $request->input('listing_title'),
            'listing_description' => $request->input('listing_description'),
            'full_day_price_set_by_user' => $request->input('price'),
            'listing_address' => $request->input('listing_address'),
            
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

    
}
