<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;

class BookingController extends Controller
{
    public function book(Request $request){
        $validated = $request->validate([
            'user_id' => 'required',
            'lister_id' => 'required',
            'listing_id' => 'required',
            'date_enter' => 'required',
            'date_exit' => 'required',
            'short_stay_flag' => 'required',
            'all_day_flag' => 'required'
        ]);

        if($validated){
            Booking::create([
                'user_id' => $request->input('user_id'),
                'lister_id' => $request->input('lister_id'),
                'listing_id' => $request->input('listing_id'),
                'date_enter' => $request->input('date_enter'),
                'date_exit' => $request->input('date_exit'),
                'short_stay_flag' => $request->input('short_stay_flag'),
                'time_id' => $request->input('time_id'),
                'all_day_flag' => $request->input('all_day_flag'),
            ]);
            return response()->json([
                'status' => 200,
                'messege' => 'Booking created successfully'
            ]);
        }else{
           return $validated->errors();
        }
    }
}
