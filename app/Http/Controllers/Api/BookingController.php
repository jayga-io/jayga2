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
use App\Models\ListerDashboard;
use App\Models\ListingImages;
use App\Models\JaygaEarn;
use App\Jobs\SendBookingEmail;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Message;
use Artisan;

class BookingController extends Controller
{
    public function book(Request $request){
        $validated = $request->validate([
            'user_id' => 'required',
            'lister_id' => 'required',
            //'booking_order_name' => 'required',
            'listing_id' => 'required',
            'date_enter' => 'required',
            'date_exit' => 'required',
            'short_stay_flag' => 'required',
            'all_day_flag' => 'required',
            'transaction_id' => 'required',
            //'phone' => 'required',
            'platform_type' => 'required',
            'invoice_number' => 'required',
            'guest_num' => 'required',
            //'email' => 'required',
            'pay_amount' => 'required',
            'listing_price' => 'required',
            'payment_flag' => 'boolean|required',
            

        ]);

        if($validated){
            
            $check = Booking::where('transaction_id', $request->input('transaction_id'))->get();
            $user = User::where('id', $request->input('user_id'))->get();
            $lister = User::where('id', $request->input('lister_id'))->get();
            if(count($check)>0){
                return response()->json([
                    'status' => false,
                    'messege' => 'Transaction id can not be same'
                ]);
            }else{
                Booking::create([
                'user_id' => $request->input('user_id'),
                'booking_order_name' => $user[0]->name,
                'transaction_id' => $request->input('transaction_id'),
                'lister_id' => $request->input('lister_id'),
                'listing_id' => $request->input('listing_id'),
                'date_enter' => $request->input('date_enter'),
                'date_exit' => $request->input('date_exit'),
                'short_stay_flag' => $request->input('short_stay_flag'),
                'tier' => $request->input('tier'),
                'total_members' => $request->input('guest_num'),
               // 'listing_type' => $request->input('listing_type'),
                'days_stayed' => $request->input('days_stayed'),
                'pay_amount' => $request->input('pay_amount'),
                'net_payable' => $request->input('listing_price'),
                'all_day_flag' => $request->input('all_day_flag'),
                'payment_flag' => $request->input('payment_flag'),
                'email' => $user[0]->email,
                'phone' => $user[0]->phone,
                'messeges' => $request->input('messege'),
                'platform_type' => $request->input('platform_type'),
                'invoice_number' => $request->input('invoice_number'),
                'created_on' => date('Y-m-d H:i:s')
            ]);

            $booked = Booking::where('transaction_id', $request->input('transaction_id'))->with('listings')->get();
           // $listing = Listing::where('listing_id', $booked[0]->listing_id)->get();
           // $time = date('Y-m-d H:i:s');
            Notification::create([
                'user_id' => $request->input('user_id'),
                'lister_id' => $request->input('lister_id'),
                'listing_id' => $request->input('listing_id'),
                'booking_id' => $booked[0]->booking_id,
                'type' => 'New Booking Request : '.$booked[0]->listings->listing_title,
                'messege' => 'Your Booking request at : '.$booked[0]->listings->listing_title. ' has been placed',
                'created_on' => date('Y-m-d H:i:s')

            ]);

            Notification::create([
                'user_id' => $request->input('lister_id'),
                'lister_id' => $request->input('lister_id'),
                'listing_id' => $request->input('listing_id'),
                'booking_id' => $booked[0]->booking_id,
                'type' => 'New Booking Request : '.$booked[0]->listings->listing_title,
                'messege' => 'Your have a new booking request for : '.$booked[0]->listings->listing_title,
                'created_on' => date('Y-m-d H:i:s')
            ]);

           

            

          // $notif_data = $lister[0]->FCM_token;

           $notif_details = [
            'token' => $lister[0]->FCM_token,
            'title' => 'New Booking Request ['.$booked[0]->listings->listing_title.']',
            'body' => 'You have a new booking request for ['.$booked[0]->listings->listing_title.']',
           ];
          // dd($notif_data);
           send_notif($notif_details);

           $data = [
            "sender_id" => "8809601010510",
            "receiver" => $lister[0]->phone,
            "message" => 'Dear user, Your listing : '. $booked[0]->listings->listing_title . ' has a new booking request',
            "remove_duplicate" => true
        ];

        send_sms($data);
          
        
          // dd($notif_data);

           // Artisan::call('queue:listen');

          // SendBookingEmail::dispatch($receipent, $subject, $data);

            /*

          if($lister[0]->phone == null){

                $receipent = $lister[0]->email;
                $subject = 'New Booking Request';

                 Mail::plain(
                    view: 'mailTemplates.NewBookingRequest',
                    data: [
                        'lister' => $lister[0]->name,
                        'listing_title' => $listing[0]->listing_title,
                        'checkin' => $booked[0]->date_enter,
                        'checkout' => $booked[0]->date_exit,
                        'guest_name' => $user[0]->name,
                    ],
                    callback: function (Message $message) use ($receipent, $subject) {
                        $message->to($receipent)->subject($subject);
                    }
                );


          }elseif($lister[0]->email == null){
                    $data = [
                        "sender_id" => "8809601010510",
                        "receiver" => $lister[0]->phone,
                        "message" => 'Dear user, Your listing : '. $listing[0]->listing_title . ' has a new booking request',
                        "remove_duplicate" => true
                    ];

                send_sms($data);
          }else{
            //mail
            $receipent = $lister[0]->email;
                $subject = 'New Booking Request';

                 Mail::plain(
                    view: 'mailTemplates.NewBookingRequest',
                    data: [
                        'lister' => $lister[0]->name,
                        'listing_title' => $listing[0]->listing_title,
                        'checkin' => $booked[0]->date_enter,
                        'checkout' => $booked[0]->date_exit,
                        'guest_name' => $user[0]->name,
                    ],
                    callback: function (Message $message) use ($receipent, $subject) {
                        $message->to($receipent)->subject($subject);
                    }
                );

                //messege
                $data = [
                    "sender_id" => "8809601010510",
                    "receiver" => $lister[0]->phone,
                    "message" => 'Dear user, Your listing : '. $listing[0]->listing_title . ' has a new booking request',
                    "remove_duplicate" => true
                ];

            send_sms($data);
          }

          if($user[0]->phone == null){
            $subject = 'Booking Request Sent';
            $receipent = $user[0]->email;

            Mail::plain(
               view: 'mailTemplates.BookingRequestSent',
               data: [
                   'user' => $user[0]->name,
                   'listing_title' => $listing[0]->listing_title,
                   'checkin' => $booked[0]->date_enter,
                   'checkout' => $booked[0]->date_exit,
               ],
               callback: function (Message $message) use ($receipent, $subject) {
                   $message->to($receipent)->subject($subject);
               }
           );
          }elseif($user[0]->email == null){
                $data = [
                    "sender_id" => "8809601010510",
                    "receiver" => $user[0]->phone,
                    "message" => 'Dear user, Your booking at : '. $listing[0]->listing_title . ' has sent to the host for review',
                    "remove_duplicate" => true
                ];

            send_sms($data);
          }else{
            //mail
            $subject = 'Booking Request Sent';
            $receipent = $user[0]->email;

            Mail::plain(
               view: 'mailTemplates.BookingRequestSent',
               data: [
                   'user' => $user[0]->name,
                   'listing_title' => $listing[0]->listing_title,
                   'checkin' => $booked[0]->date_enter,
                   'checkout' => $booked[0]->date_exit,
               ],
               callback: function (Message $message) use ($receipent, $subject) {
                   $message->to($receipent)->subject($subject);
               }
           );
           //messege
                $data = [
                    "sender_id" => "8809601010510",
                    "receiver" => $user[0]->phone,
                    "message" => 'Dear user, Your booking at : '. $listing[0]->listing_title . ' has sent to the host for review',
                    "remove_duplicate" => true
                ];

            send_sms($data);
          }

            */

            return response()->json([
                'status' => 200,
                'messege' => 'Booking created successfully',
                'booking_details' => [
                    'id' => $booked[0]->booking_id,
                    'pay_amount' => $booked[0]->pay_amount,
                    'lister_id' => $booked[0]->lister_id,
                    'listing_id' => $booked[0]->listings->listing_id,
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
            $bookings = Booking::where('user_id', $request->input('user_id'))->with('listings')->with('listings.images')->orderBy('created_at', 'DESC')->get();
            $past_bookings = BookingHistory::where('user_id', $request->input('user_id'))->with('listings')->with('listings.images')->orderBy('created_at', 'DESC')->get();
            
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
            $bookings = Booking::where('lister_id', $request->query('lister_id'))->with('listings')->with('listings.images')->orderBy('created_at', 'DESC')->get();
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
            $booking_id = Booking::where('booking_id', $request->input('booking_id'))->with('listings')->get();
            $lister = User::where('id', $booking_id[0]->lister_id)->get();
           // $listing_name = Listing::where('listing_id', $booking_id[0]->listing_id)->get();
            if($request->input('booking_status') == 1){

              Booking::where('booking_id', $request->input('booking_id'))->update([
                'booking_status' => 1,
                'isApproved' => true
              ]);
                    
                
                $phone = $booking_id[0]->phone;
                $data = [
                    "sender_id" => "8809601010510",
                    "receiver" => $phone,
                    "message" => 'Your booking request for ' .$booking_id[0]->listings->listing_title . ' has been approved. Check-in: '. $booking_id[0]->date_enter .' , Check-out: '. $booking_id[0]->date_exit .'. For assistance, contact Jayga support. ',
                    
                    "remove_duplicate" => true
                ];
                
                send_sms($data);

                $notifys = [
                    'user_id' => $booking_id[0]->user_id,
                    'lister_id' => $booking_id[0]->lister_id,
                    'listing_id' => $booking_id[0]->listing_id,
                    'booking_id' => $request->input('booking_id'),
                    'type' => 'Booking Request Confirmed',
                    'messege' => 'Your Booking : '. $booking_id[0]->listings->listing_title . ' is confirmed'
                   ];
            
                   notify($notifys);

                   

                   $notif_details = [
                    'token' => $lister[0]->FCM_token,
                    'title' => 'Booking Request Confirmed : ['.$booking_id[0]->listings->listing_title.']',
                    'body' => 'Your booking at ['.$booking_id[0]->listings->listing_title.'] is confirmed',
                   ];
                  // dd($notif_data);
                   send_notif($notif_details);


            }elseif($request->input('booking_status') == 2){
                
                Booking::where('booking_id', $request->input('booking_id'))->update([
                    'booking_status' => 2,
                    'isApproved' => false
                ]);
               // $books = Booking::where('booking_id', $request->input('booking_id'))->with('listings')->get();
           
                BookingHistory::create([
                     'user_id' => $booking_id[0]->user_id,
                     'listing_id' => $booking_id[0]->listing_id,
                     'booking_id' => $booking_id[0]->booking_id,
                     'lister_id' => $booking_id[0]->lister_id,
                     'listing_title' => $booking_id[0]->listings->listing_title,
                     'listing_type' => $booking_id[0]->listings->listing_type,
                     'short_stay_flag' => $booking_id[0]->short_stay_flag,
                     'transaction_id' => $booking_id[0]->transaction_id,
                     'date_enter' => $booking_id[0]->date_enter,
                     'date_exit' => $booking_id[0]->date_exit,
                     'tier' => $booking_id[0]->tier,
                     'total_members' => $booking_id[0]->total_members,
                     'email' => $booking_id[0]->email,
                     'phone' => $booking_id[0]->phone,
                     'pay_amount' => $booking_id[0]->pay_amount,
                     'net_payable' => $booking_id[0]->net_payable,
                     'payment_flag' => $booking_id[0]->payment_flag,
                     'booking_status' => $booking_id[0]->booking_status,
                     'isApproved' => $booking_id[0]->isApproved,
                     'isComplete' => $booking_id[0]->isComplete,
                     'created_on' => date('Y-m-d H:i:s')
                 ]);
                    
                
                $phone = $booking_id[0]->phone;
                $data = [
                    "sender_id" => "8809601010510",
                    "receiver" => $phone,
                    
                    "message" => 'Your booking request for '. $booking_id[0]->booking_order_name .' has been declined. Please apply for a refund from “My bookings”. We are sorry for any inconvenience caused. For assistance, contact Jayga support.  ',
                    "remove_duplicate" => true
                ];
                
                send_sms($data);


                $notifys = [
                    'user_id' => $booking_id[0]->user_id,
                    'lister_id' => $booking_id[0]->lister_id,
                    'listing_id' => $booking_id[0]->listing_id,
                    'booking_id' => $request->input('booking_id'),
                    'type' => 'Booking Request Declined: '. $booking_id[0]->listings->listing_title,
                    'messege' => 'Your Booking : '. $booking_id[0]->listings->listing_title . ' is declined'
                ];
            
                   notify($notifys);

                   $notif_details = [
                    'token' => $lister[0]->FCM_token,
                    'title' => 'Booking Request Declined : ['.$booking_id[0]->listings->listing_title.']',
                    'body' => 'Your booking at ['.$booking_id[0]->listings->listing_title.'] is declined',
                   ];
                  // dd($notif_data);
                   send_notif($notif_details);

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
            'amount' => 'required',
            'lister_id' => 'required'
        ]); 

        if($validated){
            $id = $request->input('booking_id');
            $amount = $request->input('amount');
            $paid_amount = $amount;
            $lister_fee = ($amount * 6.9) /100;
            $booking_fee = ($amount * 3) / 100;
    
            $lister_earn = $amount - $lister_fee;
            $jayga_earn = $amount - $booking_fee;
    
            $jayga_total = $lister_fee + $booking_fee ;
    
            Booking::where('booking_id', $id)->update([
                'isComplete' => true,
                'net_payable' => $lister_earn
            ]);
            $earning = ListerDashboard::where('lister_id', $request->input('lister_id'))->get();
            if(count($earning)>0){
               $update_earnings = $earning[0]->earnings + $lister_earn;
               $total_earn = $earning[0]->total_earnings + $lister_earn;
                ListerDashboard::where('lister_id', $request->input('lister_id'))->update([
                    'total_earnings' => $total_earn,
                    'earnings' => $update_earnings
                ]);
            }else{
                ListerDashboard::create([
                    'lister_id' => $request->input('lister_id'),
                    'total_earnings' => $lister_earn,
                    'earnings' => $lister_earn
                ]);
                
            }
    
            $books = Booking::where('booking_id', $id)->with('listings')->get();
    
            JaygaEarn::create([
                'invoice' => $books[0]->invoice_number,
                'listing_id' => $books[0]->listing_id,
                'booking_id' => $id,
                'listing_fee' => $lister_fee,
                'booking_fee' => $booking_fee,
                'total' => $jayga_total
            ]);
    
            BookingHistory::create([
                'user_id' => $books[0]->user_id,
                'listing_id' => $books[0]->listing_id,
                'booking_id' => $books[0]->booking_id,
                'lister_id' => $request->input('lister_id'),
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
                'created_on' => date('Y-m-d H:i:s')
            ]);
    
            Booking::where('booking_id', $id)->delete();
            ListingAvailable::where('booking_id', $id)->delete();

            $lister = User::where('id', $request->input('lister_id'))->get();

            $notif_details = [
                'token' => $lister[0]->FCM_token,
                'title' => 'Review Your Stay at ['.$books[0]->listings->listing_title.']',
                'body' => 'Dont forget to review your stay at ['.$books[0]->listings->listing_title.']', 
               ];
              // dd($notif_data);
               send_notif($notif_details);

            return response()->json([
                'status' => 200,
                'messege' => 'Booking Completed'
            ]);
           
        }else{
           return $validated->errors();
        }
    }

    public function completed_bookings(Request $request){
        $validated = $request->validate([
            'lister_id' => 'required'
        ]);

        if($validated){
            $completed = BookingHistory::where('lister_id', $request->query('lister_id'))->where('isComplete', true)->get();

            if(count($completed)>0){
                return response()->json([
                    'status' => 200,
                    'bookings' => $completed
                ]);
            }else{
                return response()->json([
                    'status' => 404,
                    'bookings' => 'No Bookings Found'
                ],404);
            }
        }else{
            $validated->errors();
        }
    }
}
