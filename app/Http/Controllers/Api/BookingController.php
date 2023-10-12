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
                ''
            ]);
        }
    }
}
