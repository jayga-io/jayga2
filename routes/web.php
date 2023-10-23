<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ListingController;
use App\Models\User;
use App\Models\Listing;

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
    Route::get('/add-listing', function(){
        $user = User::whereNotNull('name')->get();
     //   dd($user);
        return view('admin.add-listing')->with('users', $user);
    })->name('addlisting');

    Route::get('/pending-listing', function(){
        $listings = Listing::where('isApproved', false)->get();
        return view('admin.pending-listing')->with('pending', $listings);
    })->name('pendinglisting');

    Route::get('/view-listing', [ListingController::class, 'show']);

    Route::get('/approve-listing/{id}', [ListingController::class, 'approve']);
    
    Route::get('/decline-listing/{id}', [ListingController::class, 'destroy']);
});

Route::post('/create/listing', [ListingController::class, 'create'])->name('create_listing');

