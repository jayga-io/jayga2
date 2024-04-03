<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use App\Models\Booking;
use App\Models\Listing;
use App\Models\ListingAvailable;
use App\Models\BookingHistory;

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
                ->where('created_at', '<', now()->subHours(48))
                ->get();
               // dd($pendingBookings);

            // Update status to declined for each pending booking
            foreach ($pendingBookings as $booking) {
                
                BookingHistory::create([
                    'user_id' => $booking->user_id,
                    'listing_id' => $booking->listing_id,
                    'booking_id' => $booking->booking_id,
                    'lister_id' => $booking->lister_id,
                    'listing_title' => $booking->listings->listing_title,
                    'listing_type' => $booking->listings->listing_type,
                    'short_stay_flag' => $booking->short_stay_flag,
                    'transaction_id' => $booking->transaction_id,
                    'date_enter' => $booking->date_enter,
                    'date_exit' => $booking->date_exit,
                    'tier' => $booking->tier,
                    'total_members' => $booking->total_members,
                    'email' => $booking->email,
                    'phone' => $booking->phone,
                    'pay_amount' => $booking->pay_amount,
                    'net_payable' => $booking->net_payable,
                    'payment_flag' => $booking->payment_flag,
                    'booking_status' => $booking->booking_status,
                    'isApproved' => $booking->isApproved,
                    'isComplete' => $booking->isComplete,
                    'messeges' => 'Expired',
                ]);
                // notify($notifys);
                // $booking->save();
               // $booking->delete();
                $booking->delete();
            }
           
        })->everyMinute();
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
