<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Listing;
use App\Models\User;
use App\Models\Notification;
use App\Models\BookingHistory;
use App\Models\ListingAvailable;
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
            $listing = Listing::where('listing_id', $booked[0]->listing_id)->get();

            Notification::create([
                'user_id' => $request->input('user_id'),
                'lister_id' => $request->input('lister_id'),
                'listing_id' => $request->input('listing_id'),
                'booking_id' => $booked[0]->booking_id,
                'type' => 'Booking Placed',
                'messege' => 'Your Booking request at : '.$listing[0]->listing_title. ' has been sent for approval',

            ]);

            Notification::create([
                'user_id' => $request->input('lister_id'),
                'lister_id' => $request->input('lister_id'),
                'listing_id' => $request->input('listing_id'),
                'booking_id' => $booked[0]->booking_id,
                'type' => 'Booking Request',
                'messege' => 'Your Listing : '.$listing[0]->listing_title. ' has a new booking request',

            ]);

            
           

            
            $listing = Listing::where('listing_id', $request->input('listing_id'))->get();
            $phone = User::where('id', $booked[0]->lister_id)->get();

            $data = [
                "sender_id" => "8809601010510",
                "receiver" => $phone[0]->phone,
                "message" => 'Dear user, Your listing : '. $listing[0]->listing_title . ' has a new booking request',
                "remove_duplicate" => true
            ];

            send_sms($data);

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
            $past_bookings = BookingHistory::where('user_id', $request->input('user_id'))->with('listings')->with('listings.images')->get();
            
            if(count($bookings)>0 || count($past_bookings)>0){
                return response()->json([
                    'status' => true,
                    'bookings' => $bookings,
                    'past_bookings' => $past_bookings
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

              Booking::where('booking_id', $request->input('booking_id'))->update([
                'booking_status' => 1,
                'isApproved' => true
              ]);
                    
                
                $phone = $booking_id[0]->phone;
                $data = [
                    "sender_id" => "8809601010510",
                    "receiver" => $phone,
                    "message" => 'Dear user, Your booking at: ' .$listing_name[0]->listing_title . ' has been confirmed by the host',
                    "remove_duplicate" => true
                ];
                
                send_sms($data);

                $notifys = [
                    'user_id' => $booking_id[0]->user_id,
                    'lister_id' => $booking_id[0]->lister_id,
                    'listing_id' => $booking_id[0]->listing_id,
                    'booking_id' => $request->input('booking_id'),
                    'type' => 'Booking Approval',
                    'messege' => 'Your Booking : '. $listing_name[0]->listing_title . ' has been approved'
                   ];
            
                   notify($notifys);


            }elseif($request->input('booking_status') == 2){
                
                Booking::where('booking_id', $request->input('booking_id'))->update([
                    'booking_status' => 2,
                    'isApproved' => false
                ]);
                $books = Booking::where('booking_id', $request->input('booking_id'))->with('listings')->get();
           
                BookingHistory::create([
                     'user_id' => $books[0]->user_id,
                     'listing_id' => $books[0]->listing_id,
                     'booking_id' => $books[0]->booking_id,
                     'lister_id' => $books[0]->lister_id,
                     'listing_title' => $books[0]->listings->listing_title,
                     'listing_type' => $books[0]->listings->listing_type,
                     'short_stay_flag' => $books[0]->short_stay_flag,
                     'transaction_id' => $books[0]->transaction_id,
                     'date_enter' => $books[0]->date_enter,
                     'date_exit' => $books[0]->date_exit,
                     'tier' => $books[0]->tier,
                     'total_members' => $books[0]->total_members,
                     'email' => $books[0]->email,
                     'phone' => $books[0]->phone,
                     'pay_amount' => $books[0]->pay_amount,
                     'net_payable' => $books[0]->net_payable,
                     'payment_flag' => $books[0]->payment_flag,
                     'booking_status' => $books[0]->booking_status,
                     'isApproved' => $books[0]->isApproved,
                     'isComplete' => $books[0]->isComplete,
                 ]);
                    
                
                $phone = $booking_id[0]->phone;
                $data = [
                    "sender_id" => "8809601010510",
                    "receiver" => $phone,
                    "message" => 'Dear user, Your booking at: '. $booking_id[0]->booking_order_name . ' has been declined by the host.',
                    "remove_duplicate" => true
                ];
                
                send_sms($data);


                $notifys = [
                    'user_id' => $booking_id[0]->user_id,
                    'lister_id' => $booking_id[0]->lister_id,
                    'listing_id' => $booking_id[0]->listing_id,
                    'booking_id' => $request->input('booking_id'),
                    'type' => 'Booking Decline',
                    'messege' => 'Your Booking : '. $listing_name[0]->listing_title . ' has been declined'
                   ];
            
                   notify($notifys);
                   ListingAvailable::where('booking_id', $request->input('booking_id'))->delete();
                   Booking::where('booking_id', $request->input('booking_id'))->delete();
            }

           


           
            
                return response()->json([
                    'status' => true,
                    'bookings' => 'Booking Status changed'
                ]);
           
                
        }
        else{
            return $validated->errors();
        }

    }

    public function mark_complete(Request $request){
        $validated = $request->validate([
            'booking_id' => 'required',
            'is_complete' => 'required',
        ]);

        if($validated){
             Booking::where('booking_id', $request->input('booking_id'))->update([
                'isComplete' => $request->input('is_complete'),
                ]);
            
                return response()->json([
                    'status' => true,
                    'messege' => 'Booking completed'
                ]);
           
        }else{
           return $validated->errors();
        }
    }
}
