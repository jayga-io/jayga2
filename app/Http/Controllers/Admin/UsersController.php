<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Listing;
use App\Models\Booking;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::whereDoesntHave('listings')->with('bookings')->with('avatars')->get();
       // dd($users);
        return view('admin.users.allusers')->with('users', $users);
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function hosts()
    {
        $hosts = User::has('listings')->with('listings')->get();
        return view('admin.users.hosts')->with('hosts', $hosts);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        User::where('id', $id)->update([
            'isSuspended' => true
        ]);

        Listing::where('lister_id', $id)->update([
            'isApproved' => false,
            'isActive' => false
        ]);

        Booking::where('user_id', $id)->delete();

        $request->session()->forget('user');

        return redirect()->back()->with('success', 'User Suspended');
    }
}
