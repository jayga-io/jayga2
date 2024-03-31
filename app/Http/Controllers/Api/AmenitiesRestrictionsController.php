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
            'amenities' => 'required',
        ]);

        if($validated){
            $amenities = $request->input('amenities');
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
}
