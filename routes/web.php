<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ListingController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\WithdrawsController;
use App\Http\Controllers\Admin\RefundsController;
use App\Http\Controllers\Admin\EarningsController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Host\HostController;
use App\Http\Controllers\Host\ListerDashboardController;
use App\Http\Controllers\Host\ListerUserController;
use App\Http\Controllers\Host\AccountsController;
use App\Http\Controllers\Host\BankDetailsController;
use App\Http\Controllers\Client\ClientController;
use App\Http\Controllers\Client\ClientLoginController;
use App\Http\Controllers\Client\ClientNotificationController;
use App\Http\Controllers\Client\FavouritesController;
use App\Http\Controllers\Client\SearchController;
use App\Http\Controllers\Client\RefundController;
use App\Models\User;
use App\Models\Listing;
use App\Http\Middleware\ensureotp;
use App\Http\Middleware\HasBankAccount;
use App\Http\Middleware\HasProfile;
use App\Http\Middleware\ClientAuth;
use App\Http\Middleware\Adminauth;
use Illuminate\Http\Request;

use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [ClientController::class, 'index']);

Route::get('/link/storage', function(){
    Artisan::call('storage:link');
});


Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    return 'Application cache has been cleared';
});

Route::get('/route-cache', function() {
    Artisan::call('route:cache');
        return 'Routes cache has been cleared';
    });




  // Clear view cache:
  
  Route::get('/view-clear', function() {
      Artisan::call('view:clear');
      return 'View cache has been cleared';
  });


  Route::get('/clear/controllers', function(){
    Artisan::call('remove:controllers');
    return 'Controllers cleared';
  });

  Route::get('/clear/models', function(){
    Artisan::call('remove:models');
    return 'Models cleared';
  });

  Route::get('/clear/database', function(){
    Artisan::call('remove:database');
    return 'Database cleared';
  });



  // admin section
Route::prefix('admin')->group(function(){

    Route::middleware(Adminauth::class)->group(function(){
            Route::get('/', [AdminController::class, 'index'])->name('adminhome');
    
           
    });

    Route::get('/login', [AdminController::class, 'login'])->name('adminlogin');

    Route::post('/success', [AdminController::class, 'store'])->name('adminauth');
    
    Route::get('/add-listing', [ListingController::class, 'index'])->name('addlisting');

    Route::get('/pending-listing', [ListingController::class, 'pending_listings'])->name('pendinglisting');

    Route::get('/all-listing', function(){
        $listings = Listing::orderBy('created_at', 'DESC')->get();
        return view('admin.listings.all-listings')->with('all', $listings);
    })->name('all_listings');


    Route::get('/view-listing/{id}', [ListingController::class, 'show']);

    Route::get('/approve-listing/{id}', [ListingController::class, 'approve']);
    
    Route::get('/decline-listing/{id}', [ListingController::class, 'destroy']);

    Route::get('/delete-listing/{id}', [ListingController::class, 'delete']);

    Route::get('/enable-listing/{id}', [ListingController::class, 'enable']);

    Route::get('/disable-listing/{id}', [ListingController::class, 'disable']);


    //booking section
    Route::get('/add-booking', [BookingController::class, 'index'])->name('addbooking');

    Route::post('/create-booking', [BookingController::class, 'create'])->name('createbooking');

    Route::get('/pending-booking', [BookingController::class, 'show'])->name('pendingbooking');
    Route::get('/approve-booking/{id}', [BookingController::class, 'approve']);
    
    Route::get('/decline-booking/{id}', [bookingController::class, 'destroy']);

    Route::get('/view-booking/{id}', [BookingController::class, 'edit']);



    //withdraw section
    Route::get('/withdraw/requests', [WithdrawsController::class, 'show'])->name('withdraw_req');
    Route::get('/withdraw/confirm/{id}', [WithdrawsController::class, 'mark_paid'])->name('withdraw_confirm');

    //Refund section

    Route::get('/refunds', [RefundsController::class, 'show_refunds'])->name('show_refunds');
    Route::get('/refund-complete/{id}', [RefundsController::class, 'paid'])->name('refundcomplete');
    Route::get('/delete/refund/{id}', [RefundsController::class, 'delete'])->name('refund_del');

    //earning section
   // Route::get('/earnings', [EarningsController::class, 'show_earnings'])->name('earnings');




});





//admin section end

Route::post('/create/listing', [ListingController::class, 'create'])->name('create_listing');

Route::get('/payment/success', function(){
    return view('success');
});

Route::get('/payment/failure', function(){
    return view('failed');
});

Route::get('/back', function(){
    return redirect(route('home'));
})->name('backroute');


//host 
Route::prefix('host')->group(function(){
    //login
    Route::get('/login', [LoginController::class, 'login']);
    Route::post('/get-otp', [LoginController::class, 'get_otp'])->name('sendotp');
    Route::post('/verify', [LoginController::class, 'otpverify'])->name('otpverify');
    Route::get('/setup', function(){
        return redirect('/setup/step/2');
    });
    
});

Route::prefix('setup')->group(function(){
    Route::middleware(ensureotp::class)->group(function(){
        Route::middleware(HasProfile::class)->group(function(){
            Route::get('/step/1', [HostController::class, 'userform'])->name('step1');
            Route::get('/step/2', [HostController::class, 'hostypeform'])->name('step2');
            Route::get('/step/3', [HostController::class, 'listingform'])->name('step3');
            Route::get('/step/4', [HostController::class, 'listing_info'])->name('step4');
            Route::get('/step/5', [HostController::class, 'listing_nid'])->name('step5');
            Route::get('/step/6', [HostController::class, 'amenities'])->name('step6');
            Route::get('/step/7', [HostController::class, 'restrictions'])->name('step7');
            Route::get('/step/8', [HostController::class, 'listing_images'])->name('step8');
            Route::get('/step/9', [HostController::class, 'set_home_address'])->name('step9');
            Route::get('/step/10', [HostController::class, 'congrats'])->name('step10');

            Route::prefix('form')->group(function(){
                Route::post('/user/create', [HostController::class, 'user_create'])->name('usercreate');
                Route::post('/listing/create', [HostController::class, 'create_listing'])->name('listingcreate');
                Route::post('/listing/info', [HostController::class, 'create_infos'])->name('listinginfo');
                Route::post('/upload/files', [HostController::class, 'doc_uploads'])->name('uploadfiles');
                Route::post('/create/amenities', [HostController::class, 'create_amenities'])->name('amenities');
                Route::post('/create/restrictions', [HostController::class, 'create_restrictions'])->name('restrictions');
                Route::post('/upload/listing/images', [HostController::class, 'upload_listing_images'])->name('listingimages');
                Route::post('/set/address', [HostController::class, 'set_address'])->name('setaddress');
            });

            Route::prefix('update')->group(function(){
                Route::get('/listing', [HostController::class, 'edit_listing'])->name('correctlisting');
                Route::get('/infos', [HostController::class, 'edit_infos'])->name('correctinfos');
                Route::get('/amenities', [HostController::class, 'edit_amenities'])->name('correctamenities');
                Route::get('/restrictions', [HostController::class, 'edit_restrictions'])->name('correctrestrictions');


                Route::post('/listing/confirm', [HostController::class, 'update_listing'])->name('changelisting');
                Route::post('infos/confirm', [HostController::class, 'update_infos'])->name('changeinfos');
                Route::post('amenities/confirm', [HostController::class, 'update_amenities'])->name('changeamenities');
                Route::post('restrictions/confirm', [HostController::class, 'update_restrictions'])->name('changerestrictions');
                
            });
        });
        
            
    });

    
});


//user dashboard

Route::prefix('user')->group(function(){
    Route::middleware(ensureotp::class)->group(function(){
            Route::get('/dashboard', [ListerDashboardController::class, 'index'])->name('userdash');

            //booking
            Route::get('/manage/bookings', [ListerDashboardController::class, 'bookings'])->name('managebookings');
            Route::get('/booking-confirm/{id}', [ListerDashboardController::class, 'confirm'])->name('bookconfirm');
            Route::get('/booking-deny/{id}', [ListerDashboardController::class, 'deny'])->name('bookdeny');
            Route::get('/booking-cancel/{id}', [ListerDashboardController::class, 'cancel'])->name('bookcancel');
            Route::get('/booking-complete/{id}/{amount}', [ListerDashboardController::class, 'complete'])->name('completebooking');

            //profile
            Route::get('/profile', [ListerUserController::class, 'index'])->name('userprofile');
            Route::post('/update/profile', [ListerUserController::class, 'create'])->name('createuserprofile');

            // listings
            Route::get('/listings', [ListerDashboardController::class, 'listings'])->name('alllistings');
            Route::get('/listing/single-item/{id}', [ListerDashboardController::class, 'edit_listing'])->name('editlisting');
            Route::post('/update-listing', [ListerDashboardController::class, 'update_listing'])->name('updatelisting');
            Route::get('/delete/listing/{id}', [ListerDashboardController::class, 'delete'])->name('deletelisting');
            Route::get('/remove/listing-image/{id}', [ListerDashboardController::class, 'remove_image']);

            //accounts
            Route::get('/accounts/center', [AccountsController::class, 'accounts'])->name('acccenter');
            //bank details
            Route::post('/add/bank', [BankDetailsController::class, 'store'])->name('addbank');

            //withdraw
            Route::get('/withdraw', [AccountsController::class, 'withdraw'])->name('withdraw')->middleware(HasBankAccount::class);
            Route::post('/withdraw/confirm', [AccountsController::class, 'withdraw_request'])->name('withdrawconfirm'); Route::get('/dashboard', [ListerDashboardController::class, 'index'])->name('userdash');

            //booking
            Route::get('/manage/bookings', [ListerDashboardController::class, 'bookings'])->name('managebookings');
            Route::get('/booking-confirm/{id}', [ListerDashboardController::class, 'confirm'])->name('bookconfirm');
            Route::get('/booking-deny/{id}', [ListerDashboardController::class, 'deny'])->name('bookdeny');
            Route::get('/booking-cancel/{id}', [ListerDashboardController::class, 'cancel'])->name('bookcancel');
            Route::get('/booking-complete/{id}/{amount}', [ListerDashboardController::class, 'complete'])->name('completebooking');

            //profile
            Route::get('/profile', [ListerUserController::class, 'index'])->name('userprofile');
            Route::post('/update/profile', [ListerUserController::class, 'create'])->name('createuserprofile');

            // listings
            Route::get('/listings', [ListerDashboardController::class, 'listings'])->name('alllistings');
            Route::get('/listing/single-item/{id}', [ListerDashboardController::class, 'edit_listing'])->name('editlisting');
            Route::post('/update-listing', [ListerDashboardController::class, 'update_listing'])->name('updatelisting');
            Route::get('/delete/listing/{id}', [ListerDashboardController::class, 'delete'])->name('deletelisting');
            Route::get('/remove/listing-image/{id}', [ListerDashboardController::class, 'remove_image']);

            //accounts
            Route::get('/accounts/center', [AccountsController::class, 'accounts'])->name('acccenter');
            //bank details
            Route::post('/add/bank', [BankDetailsController::class, 'store'])->name('addbank');

            //withdraw
            Route::get('/withdraw', [AccountsController::class, 'withdraw'])->name('withdraw')->middleware(HasBankAccount::class);
            Route::post('/withdraw/confirm', [AccountsController::class, 'withdraw_request'])->name('withdrawconfirm');
    });

    
});


//client section
Route::prefix('client')->group(function(){
    Route::get('/home', [ClientController::class, 'index'])->name('home');
    Route::post('/search', [SearchController::class, 'search'])->name('searchroute');
    Route::get('/single-listing/{id}', [ClientController::class, 'show'])->name('singlelisting');
    Route::middleware(ClientAuth::class)->group(function(){
        Route::post('/book-listing', [ClientController::class, 'store'])->name('clientbooking');
        Route::get('/my-bookings', [ClientController::class, 'my_bookings'])->name('mybookings');
        Route::get('/my-notifications', [ClientNotificationController::class, 'show_notif'])->name('mynotifs');

        Route::get('/clear-notifs', [ClientNotificationController::class, 'clear_notifs'])->name('clearnotifs');
        Route::get('/update/booking/{id}', [ClientController::class, 'update']);

        Route::get('/my-favourites', [FavouritesController::class, 'show_favs'])->name('showfavs');

        Route::post('/refund-claim', [RefundController::class, 'refund_submit'])->name('claimrefund');
    });
    
   
    
   Route::get('/login', [ClientLoginController::class, 'index'])->name('clientlogin');
   Route::post('/login-otp', [ClientLoginController::class, 'otp'])->name('clientotp');
   Route::post('/otp-verify', [ClientLoginController::class, 'verify'])->name('otpverif');

   Route::get('/apply-filter', [ClientController::class, 'apply_filter'])->name('filterroute');

   Route::get('/latest', [ClientController::class, 'latest'])->name('latestlistings');
   Route::get('/popular', [ClientController::class, 'top'])->name('popularlistings');

   Route::get('/all/listings', [ClientController::class, 'all_listing'])->name('all_listing');

 Route::get('/remove/favourite/{id}', [FavouritesController::class, 'remove']);
   
  
});

Route::get('/logout', function(Request $request){
    $request->session()->flush();
    return redirect('/');
})->name('logout');


