<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notification;

class NotificationController extends Controller
{
    public function show(Request $request, $id){
      $notis =  Notification::where('user_id', $id)->with('listings')->with('bookings')->orderBy('id', 'DESC')->get();
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
}
