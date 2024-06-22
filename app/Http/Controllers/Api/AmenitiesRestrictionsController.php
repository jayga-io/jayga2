<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AmenitiesList;
use App\Models\RestrictionList;
use App\Models\ListingAmenities;
use App\Models\ListingRestricts;

class AmenitiesRestrictionsController extends Controller
{
    public function get_amenities(){
        $amn = AmenitiesList::all();
        if(count($amn)>0){
            return response()->json([
                'status' => 200,
                'amenities' => $amn
            ]);
        }else{
            return response()->json([
                'status' => 404,
                'amenities' => 'No amenities found'
            ], 404);
        }
    }

    public function get_restricts(){
        $restricts = RestrictionList::all();
        if(count($restricts)>0){
            return response()->json([
                'status' => 200,
                'restrictions' => $restricts
            ]);
        }else{
            return response()->json([
                'status' => 404,
                'restrictions' => 'No restrictions found'
            ], 404);
        }
    }

    public function add_amenities(Request $request){
        $validated = $request->validate([
            'listing_id' => 'required',
            'amenities' => 'array|required',
        ]);

        if($validated){
            $amenities = $request->input('amenities');

            $check = ListingAmenities::where('listing_id', $request->input('listing_id'))->get();

                if(count($check)>0){
                    ListingAmenities::where('listing_id', $request->input('listing_id'))->delete();
                }

            foreach ($amenities as $value) {

                
                    ListingAmenities::create([
                    
                        'listing_id' => $request->input('listing_id'),
                        'amenities_id' => $value
                    ]);
                

                
            }

            return response()->json([
                'status' => 200,
                'messege' => 'Amenities Added'
            ]);
        }else{
            return $validated->errors();
        }
    }


    public function add_restricts(Request $request){
        $validated = $request->validate([
            'listing_id' => 'required',
            'restriction_id' => 'array|required',
        ]);

        if($validated){
            $restrictions = $request->input('restriction_id');
            $check = ListingRestricts::where('listing_id', $request->input('listing_id'))->get();
                if(count($check)>0){
                    ListingRestricts::where('listing_id', $request->input('listing_id'))->delete();
                }


            foreach ($restrictions as $value) {
 
                    ListingRestricts::create([
                        'listing_id' => $request->input('listing_id'),
                        'restriction_id' => $value
                    ]);
 
            }

            return response()->json([
                'status' => 200,
                'messege' => 'Restrictions Added'
            ]);
        }else{
            return $validated->errors();
        }
    }


    public function delete_amenities(Request $request){
        $validated = $request->validate([
            'listing_id' => 'required',
            'amenities_id' => 'required',
        ]);

        if($validated){
            ListingAmenities::where('listing_id', $request->query('listing_id'))->where('amenities_id', $request->query('amenities_id'))->delete();
            return response()->json([
                'status' => 200,
                'messege' => 'Amenities Removed'
            ]);
        }else{
            return $validated->errors();
        }
    }

    public function delete_restrictions(Request $request){
        $validated = $request->validate([
            'listing_id' => 'required',
            'restriction_id' => 'required',
        ]);

        if($validated){
            ListingRestricts::where('listing_id', $request->query('listing_id'))->where('restriction_id', $request->query('restriction_id'))->delete();
            return response()->json([
                'status' => 200,
                'messege' => 'Restriction Removed'
            ]);
        }else{
            return $validated->errors();
        }
    }
    
}
