<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use App\Models\Listing;
use App\Models\Booking;
use App\Models\Withdraws;
use App\Models\Notification;
use Illuminate\Pagination\Paginator;

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
    public function boot(Request $request): void
    {
        Paginator::useBootstrapFive();
        $pending_count = Listing::where('isApproved', false)->get();
        $withdraw_count = Withdraws::where('status', false)->get();
        
       // $notifs = Notification::where('user_id', \Session::get('user'))->get();
     
        view()->share('pending_count', $pending_count->count());
      
        view()->share('withdraw_count', $withdraw_count->count());

       // view()->share('booknotifcount', $notifs->count());
      
    }
}
