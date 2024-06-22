<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use App\Models\Booking;
use App\Models\Listing;
use App\Models\ListingAvailable;
use App\Models\BookingHistory;
use App\Models\Notification;
use App\Models\User;
use Artisan;

use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->call(function () {
             // Query pending booking requests created more than 48 hours ago
                $pendingBookings = Booking::where('booking_status', 0)
                ->where('created_on', '<', now()->subHours(48))
                ->with('listings')
                ->get();
               // dd($pendingBookings);

            // Update status to declined for each pending booking
            foreach ($pendingBookings as $key => $value) {
                
                BookingHistory::create([
                    'user_id' => $value->user_id,
                    'listing_id' => $value->listing_id,
                    'booking_id' => $value->booking_id,
                    'lister_id' => $value->lister_id,
                    'listing_title' => $value->listings->listing_title,
                    'listing_type' => $value->listings->listing_type,
                    'short_stay_flag' => $value->short_stay_flag,
                    'transaction_id' => $value->transaction_id,
                    'date_enter' => $value->date_enter,
                    'date_exit' => $value->date_exit,
                    'tier' => $value->tier,
                    'total_members' => $value->total_members,
                    'email' => $value->email,
                    'phone' => $value->phone,
                    'pay_amount' => $value->pay_amount,
                    'net_payable' => $value->net_payable,
                    'payment_flag' => $value->payment_flag,
                    'booking_status' => 2,
                    'isApproved' => $value->isApproved,
                    'isComplete' => $value->isComplete,
                    'messeges' => 'Expired',
                ]);

                //Notification for user
                Notification::create([
                    'user_id' => $value->user_id,
                    'lister_id' => $value->lister_id,
                    'listing_id' => $value->listing_id,
                    'booking_id' => $value->booking_id,
                    'type' => 'booking',
                    'messege' => 'Your Booking request for : '.$value->listings->listing_title. ' has been expired',
    
                ]);
    
                //notification for lister
                Notification::create([
                    'user_id' => $value->lister_id,
                    'lister_id' => $value->lister_id,
                    'listing_id' => $value->listing_id,
                    'booking_id' => $value->booking_id,
                    'type' => 'booking',
                    'messege' => 'Your Booking request at : '.$value->listings->listing_title. ' has been expired',
    
                ]);

               // $value->delete();
            }

            Booking::where('booking_status', 0)
                ->where('created_on', '<', now()->subHours(48))
                ->delete();

           
           
        })->hourly();


        $schedule->call(function (){

            $pend_books = Booking::where('booking_status', 0)
            ->where('created_on', '<', now()->subHours(48))
            ->with('lister')
            ->get();

           foreach ($pend_books as $key => $value) {
            
            $data = [
                'token' => $value->lister->FCM_token,
                'title' => 'Booking expired',
                'body' => 'Your Booking has been expired',
             ];

             send_notif($data);
           }
            
           
        })->hourly();


        $schedule->call(function (){
            User::where('updated_at', '<', now()->subMinutes(60))->update([
                'access_token' => NULL
            ]);
        })->everyMinute();

/*
        $schedule->call(function (){
            Artisan:call('queue:listen');
        })->everyMinute();
    */
       
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
        
    }
}
