<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HostController;
use App\Http\Controllers\ListerDashboardController;
use App\Models\User;
use App\Models\Listing;
use App\Http\Middleware\ensureotp;
use Illuminate\Http\Request;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/link/storage', function(){
    Artisan::call('storage:link');
});

Route::prefix('admin')->group(function(){

    Route::get('/', function(){
        return view('admin.dashboard');
    });
    
    Route::get('/add-listing', [ListingController::class, 'index'])->name('addlisting');

    Route::get('/pending-listing', function(){
        $listings = Listing::where('isApproved', false)->get();
        return view('admin.pending-listing')->with('pending', $listings);
    })->name('pendinglisting');


    Route::get('/view-listing/{id}', [ListingController::class, 'show']);

    Route::get('/approve-listing/{id}', [ListingController::class, 'approve']);
    
    Route::get('/decline-listing/{id}', [ListingController::class, 'destroy']);


    //booking section
    Route::get('/add-booking', [BookingController::class, 'index'])->name('addbooking');

    Route::post('/create-booking', [BookingController::class, 'create'])->name('createbooking');

    Route::get('/pending-booking', [BookingController::class, 'show'])->name('pendingbooking');
    Route::get('/approve-booking/{id}', [BookingController::class, 'approve']);
    
    Route::get('/decline-booking/{id}', [bookingController::class, 'destroy']);

    Route::get('/view-booking/{id}', [BookingController::class, 'edit']);
});

Route::post('/create/listing', [ListingController::class, 'create'])->name('create_listing');

Route::get('/payment/success', function(){
    return view('success');
});

Route::get('/payment/failure', function(){
    return view('failed');
});


//host 
Route::prefix('host')->group(function(){
    //login
    Route::get('/login', [LoginController::class, 'login']);
    Route::post('/get-otp', [LoginController::class, 'get_otp'])->name('sendotp');
    Route::post('/verify', [LoginController::class, 'otpverify'])->name('otpverify');
    Route::get('/setup', function(){
        return redirect('/setup/step/1');
    })->middleware(ensureotp::class);
    
});

Route::prefix('setup')->group(function(){
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
});


//user dashboard

Route::prefix('user')->group(function(){
    Route::middleware(ensureotp::class)->group(function(){
        Route::get('/dashboard', [ListerDashboardController::class, 'index'])->name('userdash');
        Route::get('/manage/bookings', [ListerDashboardController::class, 'bookings'])->name('managebookings');
    });

    
});


Route::get('/logout', function(Request $request){
    $request->session()->flush();
    return redirect(route('userdash'));
})->name('logout');