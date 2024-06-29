<?php

namespace App\Http\Controllers\Frontend\common;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Listing;
use App\Models\ListingAvailable;
use App\Models\ListingAmenities;
use App\Models\ListingRestricts;
use App\Models\Reviews;
use App\Models\Booking;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class ListingController2 extends Controller
{
    //latest or popular listing api
    public function listing_sort(Request $request){
        $validated = $request->validate([
            'listing_cat' => 'required'
        ]);

        if($validated){
            if($request->query('listing_cat') === 'latest'){
                $ls_latest = Listing::where('isApproved', true)->where('isActive', true)->with('images')->with('reviews')->orderBy('created_at', 'DESC')->get();
                if(count($ls_latest)>0){
                    return response()->json([
                        'status' => 200,
                        'latest_listings' => $ls_latest
                    ]);
                }else{
                    return response()->json([
                        'status' => 404,
                        'latest_listings' => 'No Listings Found'
                    ], 404);
                }
            }elseif($request->query('listing_cat') === 'popular'){
                $ls_popular = Listing::where('isApproved', true)->where('isActive', true)->with('images')->with('reviews')->withCount('reviews')->orderBy('reviews_count', 'DESC')->get();
                if(count($ls_popular)>0){
                    return response()->json([
                        'status' => 200,
                        'popular_listings' => $ls_popular
                    ]);
                }else{
                    return response()->json([
                        'status' => 404,
                        'popular_listings' => 'No Listings Found'
                    ], 404);
                }
            }else{
                return response()->json([
                    'status' => 405,
                    'messege' => 'Invalid request'
                ], 405);
            }
        }else{
            return $validated->errors();
        }
    }

    

    public function search_list(Request $request){
        $validated = $request->validate([
            'listing_type' => 'required',
            'district' => 'required',
            
        ]);

        if($validated){
            $listing = QueryBuilder::for(Listing::class)->where('isApproved', true)
           ->where('isActive', true)
           ->where('listing_type', 'like', '%'.$request->query('listing_type').'%')
           ->where('district', 'like', '%'.$request->query('district').'%')
           ->with('images')
           ->with('newAmenities.amenity')
           ->with('newRestrictions.restrictions')
           ->with('reviews')
           ->get();

           if(count($listing)>0){
                return response()->json([
                    'status' => 200,
                    'listings' => $listing
                ]);
           }else{
            return response()->json([
                'status' => 404,
                'listings' => 'No Listing Found'
            ], 404);
           }

           
        }else{
            return $validated->errors();
        }

        
    }

    public function single_listing(Request $request, $id){ 

        $ls = Listing::where('listing_id', $id)->with('images')->with('newAmenities.amenity')->with('newRestrictions.restrictions')->with('reviews')->with('host')->with('booking')->get();
        $fivestarcount = Reviews::where('listing_id', $id)->where('stars', 5)->count();
        $fourstarcount = Reviews::where('listing_id', $id)->where('stars', 4)->count();
        $threestarcount = Reviews::where('listing_id', $id)->where('stars', 3)->count();
        $twostarcount = Reviews::where('listing_id', $id)->where('stars', 2)->count();
        $onestarcount = Reviews::where('listing_id', $id)->where('stars', 1)->count();
        $dis_dates = Booking::where('listing_id', $id)->get();
        $userunavailables = ListingAvailable::where('listing_id', $id)->get();
        $dates = [];
        $userdisabled_dates = [];
        
        foreach ($dis_dates as $key => $value) {
            array_push($dates, [
                'checkin' => $value->date_enter,
                'checkout' => $value->date_exit
            ]);
           
        }

        foreach ($userunavailables as $key => $value) {
           array_push($userdisabled_dates, [
            'disabled_dates_by_host' => $value->dates
           ]);
        }

       // dd($checkindates);
        if(count($ls)>0){
            $initial_count = Listing::where('listing_id', $id)->get();
            Listing::where('listing_id', $id)->update([
                'view_count' => $initial_count[0]->count + 1
            ]);
            return response()->json([
                'status' => 200,
                'listing_details' => $ls,
                'star_count' => [
                    'five_stars' => $fivestarcount,
                    'four_stars' => $fourstarcount,
                    'three_stars' => $threestarcount,
                    'two_stars' => $twostarcount,
                    'one_stars' => $onestarcount,
                ],
                'booked_dates' => $dates,
                'host_disable_dates' => $userdisabled_dates,
            ]);
        }else{
            return response()->json([
                'status' => 404,
                'listing_details' => 'No listing found'
            ], 404);
        }
    }

    public function filter_front(Request $request){
        $query = Listing::where('isApproved', true)->where('isActive', true)->with(['newAmenities.amenity', 'newRestrictions.restrictions', 'images', 'reviews']);

        if ($request->has('guest_number')) {
            $query->where('guest_num', $request->input('guest_number'));
        }

        if ($request->has('bed_number')) {
            $query->where('bed_num', $request->input('bed_number'));
        }

        if ($request->has('bathroom_number')) {
            $query->where('bathroom_num', $request->input('bathroom_number'));
        }

        if ($request->has('allow_short_stay')) {
            $query->where('allow_short_stay', $request->input('allow_short_stay'));
        }

        

        if ($request->has('listing_type')) {
            $listing_type = $request->input('listing_type');
            $query->where('listing_type', 'LIKE', '%'. $listing_type . '%');
        }

        if($request->has('min_price')){
            $query->where('full_day_price_set_by_user', '>=', $request->input('min_price'));
        }

        if($request->has('max_price')){
            $query->where('full_day_price_set_by_user', '<=', $request->input('max_price'));
        }

        if($request->has('district')){
            $query->where('district', 'LIKE', '%'.$request->input('district').'%');
        }

        if($request->has('city')){
            $query->where('town', 'LIKE', '%'.$request->input('city').'%');
        }
        
        if($request->has('amenities')){
            $validated = $request->validate([
                'amenities' => 'array'
            ]);
            if($validated){
                $amenities = $request->input('amenities');
                $listing_amenities = ListingAmenities::whereIn('amenities_id', $amenities)->get();
                $listing_ids = [];
                foreach ($listing_amenities as $key => $value) {
                    $listing_ids[] = $value->listing_id;
                }
                $query->whereIn('listing_id', $listing_ids)->get();
            }else{
                return $validated->errors();
            }
        }


        if($request->has('keyword')) {
            $keyword = $request->input('keyword');
            $query->where(function($query) use ($keyword) {
                $query->where('district', 'LIKE', '%' . $keyword . '%')
                      ->orWhere('town', 'LIKE', '%' . $keyword . '%')
                      ->orWhere('listing_address', 'LIKE', '%' . $keyword . '%')
                      ->orWhere('listing_description', 'LIKE', '%' . $keyword . '%')
                      ->orWhere('listing_title', 'LIKE', '%' . $keyword . '%');
                // Add more ->orWhere() calls for additional columns if needed
            });
        }elseif($request->has('area')){
            $town = $request->input('area');
            $town_name = explode(' ', $town);
            $query->where('town', 'LIKE', '%'. $town_name[0] .'%');
        }elseif($request->has('district')){
            $district = $request->input('district');
            $query->where('district', 'LIKE', '%'. $district . '%');
        }
        

        if($request->has('checkin') && $request->has('checkout')){
            $date1 = $request->input('checkin');
            $date2 = $request->input('checkout');
    
            
                // Parse the start and end dates
                $start = Carbon::parse($date1);
                $end = Carbon::parse($date2);
    
                // Generate the period
                $period = CarbonPeriod::create($start, $end);
    
                // Create an array to hold the dates
                $dates = [];
                $listing_ids = [];
    
                foreach ($period as $date) {
                    $dates[] = $date->format('Y-m-d');
                }
    
                $av_listings = ListingAvailable::whereIn('dates', $dates)->get();
    
                foreach ($av_listings as $key => $value) {
                    $listing_ids[] = $value->listing_id;
                }

                $query->whereNotIn('listing_id', $listing_ids);

        }


        $listings = $query->paginate(10);

        

        if(count($listings)>0){
            return response()->json([
                'status' => 200,
                'filtered_listings' => $listings
            ]);
        }else{
            return response()->json([
                'status' => 404,
                'filtered_listings' => 'No listings found'
            ], 404);
        }
       // return response()->json($listings);
    }

    
}
