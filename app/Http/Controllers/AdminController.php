<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\JaygaEarn;
use App\Models\Booking;
use App\Models\Listing;
use App\Http\Requests\StoreAdminRequest;
use App\Http\Requests\UpdateAdminRequest;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tk = JaygaEarn::all();
        $total_earned = JaygaEarn::sum('total');
        $booking_count = Booking::where('isComplete', false)->where('booking_status', 1)->count();
        $listings = Listing::where('isApproved', true)->count();
        $rooms = Listing::where('listing_type', 'room')->count();
       // dd($total_earned);
        return view('admin.dashboard')->with('tk', $tk)->with('total', $total_earned)->with('bookings', $booking_count)->with('listings', $listings)->with('rooms', $rooms);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAdminRequest $request)
    {
        //
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
    public function destroy(Admin $admin)
    {
        //
    }
}
