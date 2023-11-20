<?php

namespace App\Http\Controllers;

use App\Models\ListerDashboard;
use App\Http\Requests\StoreListerDashboardRequest;
use App\Http\Requests\UpdateListerDashboardRequest;
use App\Models\User;
use App\Models\Listing;
use App\Models\Booking;
use Illuminate\Http\Request;

class ListerDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $phone = $request->session()->get('phone');
        $id = $request->session()->get('user');
        $user = User::where('id', $id)->get();
        $listing = Listing::where('lister_id', $id)->get();
        
        return view('host.dashboard.dash')->with('phone', $phone)->with('uid', $id)->with('user', $user)->with('listing', $listing);
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
    public function store(StoreListerDashboardRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(ListerDashboard $listerDashboard)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ListerDashboard $listerDashboard)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateListerDashboardRequest $request, ListerDashboard $listerDashboard)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ListerDashboard $listerDashboard)
    {
        //
    }

    public function bookings(Request $request){
        $bookings = Booking::where('isApproved', true)->get();
       
        $pending_bookings = Booking::where('isApproved', false)->get();
        return view('host.bookings.bookings')->with('bookings', $bookings)->with('pendings', $pending_bookings);
    }

    
}
