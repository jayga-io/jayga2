<?php

namespace App\Http\Controllers\Api\email;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Message;

class BookingEmail extends Controller
{
    public function send_booking_email(Request $request){

        $validated = $request->validate([
            'booking_id' => 'required'
        ]);

        if($validated){
            $booking = Booking::where('booking_id', $request->input('booking_id'))->with('lister')->with('user')->with('listings')->get();
            if(count($booking) > 0){
                $lister = $booking[0]->lister->email;
                $subject = 'New Booking Request';

                Mail::plain(
                    view: 'mailTemplates.BookingRequestSent',
                    data: [
                        'user' => $booking[0]->lister->name,
                        'listing_title' => $booking[0]->listings->listing_title,
                        'checkin' => $booking[0]->date_enter,
                        'checkout' => $booking[0]->date_exit,
                    ],
                    callback: function (Message $message) use ($lister, $subject) {
                        $message->to($lister)->subject($subject);
                    }
                );

                $user = $booking[0]->user->email;
                $subject2 = 'Booking Request Sent';

                Mail::plain(
                    view: 'mailTemplates.BookingRequestSent',
                    data: [
                        'user' => $booking[0]->user->name,
                        'listing_title' => $booking[0]->listings->listing_title,
                        'checkin' => $booking[0]->date_enter,
                        'checkout' => $booking[0]->date_exit,
                    ],
                    callback: function (Message $message) use ($user, $subject2) {
                        $message->to($user)->subject($subject2);
                    }
                );

                return response()->json([
                    'status' => 200,
                    'messege' => 'Email sent'
                ]);
            }else{
                return response()->json([
                    'status' => 404,
                    'messege' => 'Booking not found'
                ], 404);
            }
        }else{
            return $validated->errors();
        }

        

        
    }
}
