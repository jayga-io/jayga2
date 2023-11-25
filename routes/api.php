<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\ListingController;
use App\Http\Controllers\Api\BookingController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\ReviewController;
use App\Http\Controllers\Api\UserController;


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

Route::get('/filter-listings', [ListingController::class, 'filter']);

Route::post('/user-nid/upload', [UserController::class, 'nid']);

Route::post('/listing-nid/upload', [ListingController::class, 'listing_nid']);

Route::post('/add/listing', [ListingController::class, 'create']);

Route::post('/add/listing-images', [ListingController::class, 'images']);

Route::post('/add/booking', [BookingController::class, 'book']);

Route::post('/payment', [PaymentController::class, 'pay']);

Route::post('/create/review', [ReviewController::class, 'create']);

Route::get('/reviews/{id}', [ReviewController::class, 'view']);

Route::get('/user/{id}', [UserController::class, 'getUser']);

Route::post('/user/edit', [UserController::class, 'editUser']);

Route::post('/payment/update', [PaymentController::class, 'paid']);

Route::post('/update/user/avatar', [UserController::class, 'photos']);

Route::post('/booking-history', [BookingController::class, 'booking_history']);

Route::post('/booking/lister', [BookingController::class, 'booking_for_lister']);

Route::post('/change/booking-status', [BookingController::class, 'booking_status']);

Route::get('/profile/listings/{id}', [ListingController::class, 'profile_listings']);

Route::post('/update/listing', [ListingController::class, 'update_listing']);

Route::get('/listing/image/delete/{id}', [ListingController::class, 'delete_image_listing']);

Route::get('/listing/images/{id}', [ListingController::class, 'get_listing_images']);

Route::post('/change/listing/status', [ListingController::class, 'listing_status']);

Route::post('/add/fav/listing', [ListingController::class, 'add_fav']);

Route::get('/fav/listings/{id}', [ListingController::class, 'get_fav']);

Route::get('/fav/listing/remove/{id}', [ListingController::class, 'del_fav']);