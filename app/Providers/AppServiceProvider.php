<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Listing;
use App\Models\Booking;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $pending_count = Listing::where('isApproved', false)->get();
        $withdraw_count = Withdraws::where('status', false)->get();
     
        view()->share('pending_count', $pending_count->count());
      
        view()->share('withdraw_count', $withdraw_count->count());
      
    }
}
