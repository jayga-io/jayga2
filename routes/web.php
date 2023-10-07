<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ListingController;
use App\Models\User;
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



Route::prefix('admin')->group(function(){
    Route::get('/', function(){
        return view('admin.dashboard');
    });
    Route::get('/add-listing', function(){
        $user = User::all();
     //   dd($user);
        return view('admin.add-listing')->with('users', $user);
    });
});

Route::post('/create/listing', [ListingController::class, 'create'])->name('create_listing');