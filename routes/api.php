<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\ListingController;
use App\Http\Controllers\Api\BookingController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\ReviewController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ListingAvailability;
use App\Http\Controllers\Api\NotificationController;
use App\Http\Controllers\Api\VoucharController;
use App\Http\Controllers\Api\HostController;
use App\Http\Controllers\Api\AmenitiesRestrictionsController;
use App\Http\Controllers\Api\RefundsController;
use App\Http\Controllers\Api\AccountDashboardController;
use App\Http\Controllers\Api\WithdrawsController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\Api\ListingUtilityController;
use App\Http\Controllers\Api\TimeSlotsController;
use App\Http\Controllers\Api\FeedbackController;
use App\Http\Controllers\Api\ReportsController;
use App\Http\Controllers\Api\UserVoucharController;
use App\Http\Controllers\Api\StorageController;
use App\Http\Controllers\Api\ChatsController;
use App\Http\Controllers\Api\PushnotifController;

use App\Http\Controllers\FirebaseController;


use App\Http\Controllers\Frontend\common\ListingController2;
use App\Http\Controllers\Frontend\user\UserloginController;
use App\Http\Controllers\Frontend\user\UserdetailsController;


//email
use App\Http\Controllers\Api\email\BookingEmail;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/signin', [LoginController::class, 'signin']);

Route::post('/register', [LoginController::class, 'register']);

Route::get('/listings' , [ListingController::class, 'listings']);

Route::post('/filter-listings', [ListingController::class, 'filtering']);

Route::post('/user-nid/upload', [UserController::class, 'nid']);

Route::post('/listing-nid/upload', [ListingController::class, 'listing_nid']);

Route::post('/add/listing', [ListingController::class, 'create']);

Route::post('/add/listing-images', [ListingController::class, 'add_images']);

Route::post('/remove/listing-images', [ListingController::class, 'remove_images']);

Route::post('/add/booking', [BookingController::class, 'book']);

Route::post('/payment', [PaymentController::class, 'pay']);

Route::post('/create/review', [ReviewController::class, 'create']);

Route::get('/reviews/{id}', [ReviewController::class, 'view']);

Route::get('/user/{id}', [UserController::class, 'getUser']);

Route::post('/user/edit', [UserController::class, 'editUser']);

Route::post('/payment/update', [PaymentController::class, 'paid']);

Route::post('/update/user/avatar', [UserController::class, 'photos']);

Route::post('/booking-history', [BookingController::class, 'booking_history']);

Route::get('/booking/lister', [BookingController::class, 'booking_for_lister']); 

Route::post('/change/booking-status', [BookingController::class, 'booking_status']);

Route::get('/profile/listings/{id}', [ListingController::class, 'profile_listings']);

Route::post('/update/listing', [ListingController::class, 'update_listing']);

Route::get('/listing/image/delete/{id}', [ListingController::class, 'delete_image_listing']);

Route::get('/listing/images/{id}', [ListingController::class, 'get_listing_images']);

Route::post('/change/listing/status', [ListingController::class, 'listing_status']);

Route::post('/add/fav/listing', [ListingController::class, 'add_fav']);

Route::get('/fav/listings/{id}', [ListingController::class, 'get_fav']);

Route::post('/fav/listing/remove', [ListingController::class, 'del_fav']);

Route::get('/user/avatars/{id}', [UserController::class, 'user_avatars']);

Route::post('/user/set-cover', [UserController::class, 'set_cover']);

Route::get('/user/get-cover/{id}', [UserController::class, 'get_cover']);

Route::post('/add/availability', [ListingAvailability::class, 'store_dates']);

Route::post('/del/availability', [ListingAvailability::class, 'del_dates']);

Route::get('/show/availability/{id}', [ListingAvailability::class, 'get_dates']);

Route::get('/show/notifications/{id}', [NotificationController::class, 'show']);

Route::post('/booking/make-complete', [BookingController::class, 'mark_complete']);

Route::post('/user/delete', [UserController::class, 'user_delete']);

//vouchar api
Route::post('/get/vouchar', [VoucharController::class, 'get_vouchar']);

//add bank info
Route::post('/add/bank', [HostController::class, 'add_bank']);

//get bank info
Route::get('/get/bank', [HostController::class, 'get_bank']);

//withdraw history
Route::get('/wh/history', [HostController::class, 'withdraw_history']);

//amenity list
Route::get('/amenities/all', [AmenitiesRestrictionsController::class, 'get_amenities']);

//restrictions
Route::get('/retrictions/all', [AmenitiesRestrictionsController::class, 'get_restricts']);

//refund claim
Route::post('/claim/refund', [RefundsController::class, 'claim_refund']);

// add amenities with listingid
Route::post('/add/listing/amenities', [AmenitiesRestrictionsController::class, 'add_amenities']);

//add restrictions with listing
Route::post('/add/listing/restrictions', [AmenitiesRestrictionsController::class, 'add_restricts']);

//dashboard info
Route::get('/lister-dashboard', [AccountDashboardController::class, 'dashboard']);

//withdraw submit
Route::post('/request/withdraw', [WithdrawsController::class, 'postRequest']);

//remove bank
Route::post('/remove/card', [HostController::class, 'delBank']);

//completed boookings
Route::get('/completed/bookings', [BookingController::class, 'completed_bookings']);

//remove amenties
Route::get('/remove/amenity', [AmenitiesRestrictionsController::class, 'delete_amenities']);

//remove retrictions
Route::get('/remove/restrictions', [AmenitiesRestrictionsController::class, 'delete_restrictions']);

//update bank details
Route::post('/update/user/bank-details', [HostController::class, 'update_bank']);


//location api
Route::get('/all/districts', [LocationController::class, 'index']);

//timeslots api
Route::get('/short-stay/slots', [TimeSlotsController::class, 'timeslots']);

//feedback
Route::post('/submit/feedback', [FeedbackController::class, 'create']);

//feedback web
Route::post('/feedback/web', [FeedbackController::class, 'feedback_web']);

//server key api firebase
Route::post('/set/server-key', [FirebaseController::class, 'create']);

//add disable slots
Route::post('/add/disable-slots', [ListingAvailability::class, 'store_disabled_slots']);

//report submit api
Route::post('/submit/report', [ReportsController::class, 'submit_report']);

//get report categories
Route::get('/report-categories', [ReportsController::class, 'get_report_categories']);


//add user vouchar api
Route::post('/user/add/vouchar', [UserVoucharController::class, 'add_vouchar_user']);

//get user vouchar
Route::get('/user/vouchars/{id}', [UserVoucharController::class, 'get_vouchar']);

//user valid vouchars
Route::post('/user/valid/vouchars', [UserVoucharController::class, 'user_valid_vouchars']);



//Email Sending Apis
Route::post('/send/booking-email', [BookingEmail::class, 'send_booking_email']);
Route::post('/send/listing-email', [ListingEmail::class, 'send_listing_email']);

//storage request api
Route::post('/send/storage/request', [StorageController::class, 'send_storage_request']);

//chats api
Route::get('/get/chats', [ChatsController::class, 'get_chat']);
Route::post('/create/chats', [ChatsController::class, 'create_chat']);


//Notification send
Route::post('/send/push-notif', [PushnotifController::class, 'send_notif']);

//Notification read count and mark read
Route::get('/unread/notif/count', [NotificationController::class, 'get_unread_count']);
Route::post('/mark/read/notif', [NotificationController::class, 'mark_read']);


//Front side apis

//listing side apis
Route::prefix('listings')->group(function(){
    Route::get('/sort', [ListingController2::class, 'listing_sort'])->name('listing_sort'); 
    Route::post('/filter-listing', [ListingController2::class, 'filter_front'])->name('filterlisting');
    Route::get('/search-listing', [ListingController2::class, 'search_list'])->name('searchlisting');
    Route::get('/single-listing/{id}', [ListingController2::class, 'single_listing'])->name('single-listing');
    
});

//user login and details apis

//user info update
Route::prefix('auth')->group(function(){
    Route::post('/login', [UserloginController::class, 'login'])->name('authuser');
    Route::post('/otp-verify', [UserloginController::class, 'verify_otp'])->name('otpauthuserverify');
    Route::get('/get-user', [UserloginController::class, 'get_user'])->name('fetchuser');
    Route::post('/update-user', [UserLoginController::class, 'update_user'])->name('update_user');
    Route::post('/update/user/image', [UserController::class, 'photos'])->name('updateuserimage');
    Route::post('/update/user/nid', [UserController::class, 'nid'])->name('updateusernid');
});

//user notifications & bookings
Route::prefix('client')->group(function(){
    Route::get('/notifications', [UserdetailsController::class, 'notifications'])->name('usernotifs');
    Route::get('/bookings', [UserdetailsController::class, 'my_bookings'])->name('userbookings');
    //user refunds claim
    Route::post('/claim/refund', [RefundsController::class, 'claim_refund']);
    //submit review
    Route::post('/submit/review', [ReviewController::class, 'create']);
    //get reviews
    Route::get('/get/reviews', [ReviewController::class, 'view']);
    //vouchar
    Route::get('/vouchars', [VoucharController::class, 'get_vouchar']);

});

//Listing utility bill add
Route::post('/add/listing-utility', [ListingUtilityController::class, 'create']);

Route::prefix('host')->group(function(){
    Route::post('/booking/complete', [BookingController::class, 'mark_complete']);
    Route::post('/booking-status', [BookingController::class, 'booking_status']);
});





