<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notification;

class ClientNotificationController extends Controller
{
    public function show_notif(Request $request){
        $user = $request->session()->get('user');
        $notif = Notification::where('user_id', $user)->where('type', 'booking')->with('listing_image')->orderBy('created_at', 'DESC')->get();
       // dd($notif);
       return view('client.notifications.mynotifications')->with('notifs', $notif);
    }

    public function clear_notifs(Request $request){
        $user = $request->session()->get('user');
        $notif = Notification::where('user_id', $user)->where('type', 'booking')->delete();
        return redirect(route('mynotifs'))->with('messege', 'Notifications cleared');
    }
}
