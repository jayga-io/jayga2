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
            'dates' => 'required',
            //'booking_id' => 'required',
        ]);
        $date = $request->input('dates');
        $dates = explode(',', $date);

        if($validated){
            foreach ($dates as $value) {
                ListingAvailable::create([
                'lister_id' => $request->input('lister_id'),
                'listing_id' => $request->input('listing_id'),
                'booking_id' => $request->input('booking_id'),
                'dates' => $value

            ]);
            }
            
            return response()->json([
                'status' => 200,
                'messege' => 'Listing availability stored'
            ]);
        }else{
            $validated->errors();
        }
    }

    public function get_dates(Request $request, $id){
       $dates = ListingAvailable::where('listing_id', $id)->groupBy('dates')->get();
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

    public function del_dates(Request $request){
        $date = $request->input('date');
        $find = ListingAvailable::where('dates', $date)->where('listing_id', $request->input('listing_id'))->where('lister_id', $request->input('lister_id'))->get();
        if(count($find)>0){
            ListingAvailable::where('dates', $date)->where('listing_id', $request->input('listing_id'))->where('lister_id', $request->input('lister_id'))->delete();
            return response()->json([
                'status' => 200,
                'messege' => 'Listing date removed'
            ]);
        }else{
            return response()->json([
                'status' => false,
                'messege' => 'Listing date not found'
            ]);
        }
    }
}
