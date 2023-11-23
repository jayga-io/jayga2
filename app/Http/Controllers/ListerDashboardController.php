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
        $bookings = Booking::where('isApproved', true)->where('booking_status', 1)->get();
       
        $pending_bookings = Booking::where('booking_status', 0)->get();
        return view('host.bookings.bookings')->with('bookings', $bookings)->with('pendings', $pending_bookings);
    }

    public function confirm(Request $request, $id){
        Booking::where('booking_id', $id)->update([
            'booking_status' => 1,
            'isApproved' => true
        ]);
        toastr()->addSuccess('Booking has been confirmed');
        return redirect()->back();
        
    }

    public function deny(Request $request, $id){
        Booking::where('booking_id', $id)->update([
            'booking_status' => 2,
            'isApproved' => true
        ]);
        toastr()->addWarning('Booking has been declined');
        return redirect()->back();
    }

    public function cancel(Request $request, $id){
        Booking::where('booking_id', $id)->update([
            'booking_status' => 2,
        ]);
        toastr()->addWarning('Booking has been canceled');
        return redirect()->back();
    }

    
}
