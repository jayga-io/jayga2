<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ListingAvailable;

class ListingAvailability extends Controller
{
    public function store_dates(Request $request){
        $validated = $request->validate([
            'listing_id' => 'required',
            'lister_id' => 'required',
            'dates' => 'required'
        ]);
        $date = $request->input('dates');
        $dates = explode(',', $date);
        if($validated){
            ListingAvailable::create([
                'lister_id' => $request->input('lister_id'),
                'listing_id' => $request->input('listing_id'),
                'dates' => $dates

            ]);
            return response()->json([
                'status' => 200,
                'messege' => 'Listing availability stored'
            ]);
        }else{
            $validated->errors();
        }
    }

    public function get_dates(Request $request, $id){
       $dates = ListingAvailable::where('listing_id', $id)->get();
       if(count($dates)>0){
        return response()->json([
            'status' => 200,
            'dates' => $dates 
        ]);
       }else{
        return response()->json([
            'status' => 404,
            'messege' => 'Not found'
        ]);
       }
    }
}
