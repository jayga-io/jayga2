<?php

namespace App\Http\Controllers\Frontend\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notification;
use App\Models\Booking;
use App\Models\BookingHistory;

class UserdetailsController extends Controller
{
    
     public function notifications(Request $request){
        $validated = $request->validate([
            'user_id' => 'required'
        ]);

        if($validated){
            $notis = Notification::where('user_id', $request->query('user_id'))->with('listing_image')->get();
            if(count($notis) > 0){
                return response()->json([
                    'status' => 200,
                    'notifications' => $notis
                ]);
            }else{
                return response()->json([
                    'status' => 404,
                    'notifications' => 'No notifications found'
                ], 404);
            }
        }else{
            return $validated->errors();
        }
    }


    public function my_bookings(Request $request){
        $validated = $request->validate([
            'user_id' => 'required'
        ]);

        if($validated){
            $bookings = Booking::where('user_id', $request->query('user_id'))->with('listings')->with('listings.images')->get();
            $past_bookings = BookingHistory::where('user_id', $request->query('user_id'))->with('listings')->with('listings.images')->get();
            
            if(count($bookings)>0 || count($past_bookings)>0){
                return response()->json([
                    'status' => 200,
                    'bookings' => $bookings,
                    'past_bookings' => $past_bookings
                ]);
            }else{
                return response()->json([
                    'status' => 404,
                    'messege' => 'No Bookings Found'
                ], 404);
            }
        }else{
            return $validated->errors();
        }
    }
}
