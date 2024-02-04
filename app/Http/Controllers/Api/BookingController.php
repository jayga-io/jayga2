<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Listing;
use Illuminate\Support\Facades\Http;

class BookingController extends Controller
{
    public function book(Request $request){
        $validated = $request->validate([
            'user_id' => 'required',
            'lister_id' => 'required',
            'booking_order_name' => 'required',
            'listing_id' => 'required',
            'date_enter' => 'required',
            'date_exit' => 'required',
            'short_stay_flag' => 'required',
            'all_day_flag' => 'required',
            'transaction_id' => 'required',
            'phone' => 'required',

        ]);

        if($validated){
            
            $check = Booking::where('transaction_id', $request->input('transaction_id'))->get();
            if(count($check)>0){
                return response()->json([
                    'status' => false,
                    'messege' => 'Transaction id can not be same'
                ]);
            }else{
                Booking::create([
                'user_id' => $request->input('user_id'),
                'booking_order_name' => $request->input('booking_order_name'),
                'transaction_id' => $request->input('transaction_id'),
                'lister_id' => $request->input('lister_id'),
                'listing_id' => $request->input('listing_id'),
                'date_enter' => $request->input('date_enter'),
                'date_exit' => $request->input('date_exit'),
                'short_stay_flag' => $request->input('short_stay_flag'),
                'tier' => $request->input('tier'),
               // 'listing_type' => $request->input('listing_type'),
                'days_stayed' => $request->input('days_stayed'),
                'pay_amount' => $request->input('pay_amount'),
                'all_day_flag' => $request->input('all_day_flag'),
                'payment_flag' => $request->input('payment_flag'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'messeges' => $request->input('messege'),
                'platform_type' => $request->input('platform_type'),
                'invoice_number' => $request->input('invoice_number'),
            ]);

            $booked = Booking::where('transaction_id', $request->input('transaction_id'))->get();
            $listing = Listing::where('listing_id', $request->input('listing_id'))->get();
            return response()->json([
                'status' => 200,
                'messege' => 'Booking created successfully',
                'booking_details' => [
                    'id' => $booked[0]->booking_id,
                    'pay_amount' => $booked[0]->pay_amount,
                    'lister_id' => $booked[0]->lister_id,
                    'listing_id' => $listing[0]->listing_id,
                    'booking_order_name' => $booked[0]->booking_order_name,
                    'transaction_id' => $booked[0]->transaction_id,
                ]
            ]);
        }
            
        }else{
           return $validated->errors();
        }
    }

    public function booking_history(Request $request){
        $validated = $request->validate([
            'user_id' => 'required'
        ]);

        if($validated){
            $bookings = Booking::where('user_id', $request->input('user_id'))->with('listings')->with('listings.images')->get();
            if(count($bookings)>0){
                return response()->json([
                    'status' => true,
                    'bookings' => $bookings
                ]);
            }else{
                return response()->json([
                    'status' => false,
                    'messege' => 'No Bookings Found'
                ]);
            }
        }else{
            return $validated->errors();
        }
    }

    public function booking_for_lister(Request $request){
        $validated = $request->validate([
            'lister_id' => 'required'
        ]);

        if($validated){
            $bookings = Booking::where('lister_id', $request->input('lister_id'))->with('listings')->with('listings.images')->get();
            if(count($bookings)>0){
                return response()->json([
                    'status' => true,
                    'bookings' => $bookings
                ]);
            }else{
                return response()->json([
                    'status' => false,
                    'messege' => 'No Bookings Found'
                ]);
            }
        }else{
            return $validated->errors();
        }
    }

    public function booking_status(Request $request){
        $validated = $request->validate([
            'booking_id' => 'required',
            'booking_status' => 'required',
        ]);
        if($validated){
            $booking_id = Booking::where('booking_id', $request->input('booking_id'))->get();
            $listing_name = Listing::where('listing_id', $booking_id[0]->listing_id)->get();
            if($request->input('booking_status') == 1){

                $url = 'https://sysadmin.muthobarta.com/api/v1/send-sms';
                    
                
                $phone = $booking_id[0]->phone;
                $data = [
                    "sender_id" => "8809601010510",
                    "receiver" => $phone,
                    "message" => 'Your booking' .$listing_name[0]->listing_title . ' has been confirmed',
                    "remove_duplicate" => true
                ];
                $response = Http::withHeaders([
                    'Authorization' => 'Token d275d614a4ca92e21d2dea7a1e2bb81fbfac1eb0',
                    
                ])->post($url, $data);

                $notifys = [
                    'user_id' => $booking_id[0]->user_id,
                    'lister_id' => $booking_id[0]->lister_id,
                    'listing_id' => $booking_id[0]->listing_id,
                    'booking_id' => $request->input('booking_id'),
                    'type' => 'Booking',
                    'messege' => 'Your Booking : '. $listing_name[0]->listing_title . ' has been approved'
                   ];
            
                   notify($notifys);


            }elseif($request->input('booking_status') == 2){
                
                $url = 'https://sysadmin.muthobarta.com/api/v1/send-sms';
                    
                
                $phone = $booking_id[0]->phone;
                $data = [
                    "sender_id" => "8809601010510",
                    "receiver" => $phone,
                    "message" => 'Your booking: '. $booking_id[0]->booking_order_name . ' has been declined',
                    "remove_duplicate" => true
                ];
                $response = Http::withHeaders([
                    'Authorization' => 'Token d275d614a4ca92e21d2dea7a1e2bb81fbfac1eb0',
                    
                ])->post($url, $data);


                $notifys = [
                    'user_id' => $booking_id[0]->user_id,
                    'lister_id' => $booking_id[0]->lister_id,
                    'listing_id' => $booking_id[0]->listing_id,
                    'booking_id' => $request->input('booking_id'),
                    'type' => 'Booking',
                    'messege' => 'Your Booking : '. $listing_name[0]->listing_title . ' has been declined'
                   ];
            
                   notify($notifys);
            }

             Booking::where('booking_id', $request->input('booking_id'))->update([
                'booking_status' => $request->input('booking_status'),
                ]);
            
                return response()->json([
                    'status' => true,
                    'bookings' => 'Booking Status changed'
                ]);
           
                
        }
        else{
            return $validated->errors();
        }

    }
}
