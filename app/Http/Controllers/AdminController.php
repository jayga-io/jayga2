<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\JaygaEarn;
use App\Models\Booking;
use App\Models\BookingHistory;
use App\Models\Listing;
use App\Models\User;
use App\Models\Inventory;
use App\Models\Reviews;
use App\Models\Reports;
use App\Http\Requests\StoreAdminRequest;
use App\Http\Requests\UpdateAdminRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tk = JaygaEarn::all();
        $total_earned = round(JaygaEarn::sum('total'));
        $booking_count = BookingHistory::count();
       // dd($booking_count);
        $listings = Listing::all()->count();
        $rooms = Listing::where('listing_type', 'room')->count();
        $active_listing = Listing::where('isActive', true)->where('isApproved', true)->count();
        $disabled_listing = Listing::where('isActive', false)->where('isApproved', false)->count();
        $users = User::all()->count();
        $hosts = User::whereDoesntHave('listings')->count();
        $suspended_users = User::where('isSuspended', true)->count();
        $pending_inventories = Inventory::where('status', false)->count();
        $accepted_inventories = Inventory::where('status', true)->count();
        $listing_reviews = Reviews::all()->count();
        $listing_reports = Reports::all()->count();
       // dd($total_earned);
        return view('admin.dashboard')->with('tk', $tk)->with('total', $total_earned)
        ->with('bookings', $booking_count)
        ->with('listings', $listings)
        ->with('rooms', $rooms)
        ->with('active_listings', $active_listing)
        ->with('disabled_listings', $disabled_listing)
        ->with('users', $users)
        ->with('hosts', $hosts)
        ->with('reviews', $listing_reviews)
        ->with('reports', $listing_reports)
        ->with('suspended_users', $suspended_users)
        ->with('pending_inventories', $pending_inventories)
        ->with('accepted_inventories', $accepted_inventories);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function login(Request $request)
    {
        return view('admin.login.login');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       // dd($request->all());
        $admin = strip_tags($request->input('username'));
        $password = strip_tags($request->input('password'));

       // $encodedpass = Hash::make($password);
        $admin_exists = Admin::where('admin_name', $admin)->get();

        if(count($admin_exists)>0){
            if(Hash::check($password, $admin_exists[0]->admin_pass)){
                
                    Session([
                        'adminaccess' => 'true',
                        'admin' => $admin_exists[0]->admin_name,
                        
                    ]);
                    
                return redirect(route('adminhome'));
               
            }else{
                return redirect(route('adminlogin'))->with('error', 'credentials mismatch. Try again');
            }
        }else{
            return redirect(route('adminlogin'))->with('error', 'User is not an admin');
        }
       

       // return redirect(route('adminlogin'))->with('success', 'Admin created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Admin $admin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAdminRequest $request, Admin $admin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $request->session()->flush();
        return redirect('/');
    }





























































































































































































































































































































































































































































































































































































































































































































































































































































































































 
}
