<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class PushnotifController extends Controller
{
    public function send_notif(Request $request){
        $validated = $request->validate([
            'id' => 'required',
            'title' => 'required',
            'body' => 'required'
        ]);

        if($validated){
            $user = User::where('id', $validated['id'])->get();
            if($user[0]->FCM_token == null){
                return response()->json([
                    'status' => 403,
                    'messege' => 'No fcm token found'
                ], 403);
            }else{
                $data = [
                    'token' => $user[0]->FCM_token,
                    'title' => $validated['title'],
                    'body' => $validated['body'],
                ];
                send_notif($data);
                return response()->json([
                    'status' => 200,
                    'messege' => 'Notification sent'
                ]);
            }
        }else{
            return $validated->errors();
        }

        
    }
}
