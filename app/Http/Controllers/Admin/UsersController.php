<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Listing;
use App\Models\Booking;
use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Message;

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
    public function suspend(Request $request, $id)
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

        $suspend_user = User::where('id', $id)->get();

        $receipent = $suspend_user[0]->email;
        $subject = 'Account Suspended';
       // $time = date("Y-m-d H:i:s");
        
       // $destinationaccount = $;
         Mail::plain(
            view: 'mailTemplates.usersuspended',
            data: [
                'user' =>$suspend_user[0]->name,
                
                
            ],
            callback: function (Message $message) use ($receipent, $subject) {
                $message->to($receipent)->subject($subject);
            }
        );

        return redirect()->back()->with('success', 'User Suspended');
    }

    public function unsuspend(Request $request, $id){
        User::where('id', $id)->update([
            'isSuspended' => false
        ]);

        Listing::where('lister_id', $id)->update([
            'isApproved' => true,
            'isActive' => true
        ]);

        return redirect()->back()->with('success', 'User Unsuspended');
    }

    public function sendMessege(Request $request){
        $contact_address = $request->input('contactaddress');
        $messege = $request->input('messege');
        $pattern = '/^\S+@\S+\.\S+$/';

        if(is_numeric($contact_address)){
            $data = [
                    
                "receiver" => $contact_address,
                "message" => $messege,
                "remove_duplicate" => true
            ];

            send_sms($data);

            return redirect()->back()->with('success', 'Messege successfully sent!');

        }elseif(preg_match($pattern, $contact_address)){
            $to_email = $contact_address;
            $subject = 'Jayga Support';
            $message = $messege;
    
                // Send email
                Mail::raw($message, function($message) use ($to_email, $subject) {
                    $message->to($to_email)->subject($subject);
                });

            return redirect()->back()->with('success', 'Messege successfully sent!');
        }
    }
}
