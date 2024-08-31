<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notification;

class NotificationController extends Controller
{
    public function show(Request $request, $id){
     // $notis =  Notification::where('user_id', $id)->with('listings')->with('bookings')->orderBy('created_at', 'DESC')->get();
        $notis = [];
        Notification::where('user_id', $id)->with('listings')->with('bookings')->orderBy('created_at', 'DESC')->chunk(100, function($notifs) use(&$notis){
            foreach($notifs as $notf){
               // dd($notf);
                $notis[] = $notf;
            }
        }); 
     // $lister_notis = Notification::where('lister_id', $user_notis[0]->)
        if(count($notis)>0){
            return response()->json([
                'status' => 200,
                'Notifications' => $notis
            ]);
        }else{
            return response()->json([
                'status' => 404,
                'messege' => 'No notifications found'
            ]);
        }
    }

    public function mark_read(Request $request){
        $validated = $request->validate([
            'user_id' => 'required'
        ]);

        if($validated){
            Notification::where('user_id', $validated['user_id'])->update([
                'isRead' => true
            ]);

            return response()->json([
                'status' => 200,
                'messege' => 'Notifications marked read'
            ]);
        }else{
            $validated->errors();
        }
    }

    public function get_unread_count(Request $request){
        $validated = $request->validate([
            'user_id' => 'required'
        ]);

        if($validated){
            $unread_count = Notification::where('user_id', $request->query('user_id'))->where('isRead', false)->count();
            return response()->json([
                'status' => 200,
                'unread_notif_count' => $unread_count
            ]);
        }else{
            $validated->errors();
        }
    }
}
