<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AmenitiesList;
use App\Models\RestrictionList;

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
}
