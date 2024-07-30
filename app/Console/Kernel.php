<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use App\Models\Booking;
use App\Models\Listing;
use App\Models\ListingAvailable;
use App\Models\BookingHistory;
use App\Models\Notification;
use App\Models\User;
use App\Models\Vouchar;
use Artisan;
use Carbon\Carbon;

use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
       
       
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
