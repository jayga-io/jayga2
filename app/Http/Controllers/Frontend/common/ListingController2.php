<?php

namespace App\Http\Controllers\Frontend\common;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Listing;
use App\Models\Reviews;
use App\Models\Booking;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;

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

    public function filter_list(Request $request){

        $validated = $request->validate([
            'listing_type' => 'required',
            'min_price' => 'required',
            'max_price' => 'required',
            'allow_short_stay' => 'required',
            'guest_num' => 'required',
            'bed_num' => 'required',
            'bathroom_num' => 'required',

        ]);
        if($validated){
            $filter = QueryBuilder::for(Listing::class)->where('isApproved', true)->where('isActive', true)->where('listing_type', $request->query('listing_type'))->where('full_day_price_set_by_user', '>=', $request->query('min_price'))->where('full_day_price_set_by_user', '<=', $request->query('max_price'))->where('allow_short_stay', $request->query('allow_short_stay'))->allowedFilters(['guest_num', 'bed_num', 'bathroom_num'])->with('images')->with('amenities')->with('restrictions')->with('reviews')->get();
            if(count($filter)>0){
                return response()->json([
                    'status' => 200,
                    'filterd_listings' => $filter
                ]);
            }else{
                return response()->json([
                    'status' => 404,
                    'filterd_listings' => 'No Listings Found'
                ], 404);
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
           ->with('amenities')
           ->with('restrictions')
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
        $dates = [];
        
        foreach ($dis_dates as $value) {
            array_push($dates, [
                'checkin' => $value->date_enter,
                'checkout' => $value->date_exit
            ]);
           
        }
       // dd($checkindates);
        if(count($ls)>0){
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
                'disable_dates' => $dates
            ]);
        }else{
            return response()->json([
                'status' => 404,
                'listing_details' => 'No listing found'
            ], 404);
        }
    }
}
