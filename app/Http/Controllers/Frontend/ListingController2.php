<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Listing;
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
            'city' => 'string',
            'guest_num' => 'integer',
            'checkin' => 'date',
            'checkout' => 'date',
        ]);

        if($validated){
            $listing = QueryBuilder::for(Listing::class)->where('isApproved', true)
           ->where('isActive', true)
           ->where('listing_type', $request->query('listing_type'))
           ->where('district', $request->query('district'))
           ->where('guest_num', $request->query('guest_num'))
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
}
