<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Chat;

class ChatsController extends Controller
{
    public function create_chat(Request $request){
        $validated = $request->validate([
            'text' => 'required',
            'user_id' => 'required',
            'lister_id' => 'required',
            'input_type' => 'required|string',
            'chat_status' => 'required|integer',
            'send_by' => 'required|string',
            'listing_id' => 'required',
            'booking_id' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:5048',
        ]);
        
        if($validated){
            if($request->hasFile('image')){
                $file = $request->file('image');
                $file->store('chats');
                Chat::create([
                    'text' => $validated['text'],
                    'user_id' => $validated['user_id'] ,
                    'lister_id' => $validated['lister_id'] ,
                    'input_type' => $validated['input_type'] ,
                    'chat_status' => $validated['chat_status'] ,
                    'send_by' => $validated['send_by'] ,
                    'listing_id' => $validated['listing_id'] ,
                    'booking_id' => $validated['booking_id'] ,
                    'image' => $file->hashName() ,
                    'created_on' => date('Y-m-d H:i:s')
                ]);
            }else{
                Chat::create([
                    'text' => $validated['text'],
                    'user_id' => $validated['user_id'] ,
                    'lister_id' => $validated['lister_id'] ,
                    'input_type' => $validated['input_type'] ,
                    'chat_status' => $validated['chat_status'] ,
                    'send_by' => $validated['send_by'] ,
                    'listing_id' => $validated['listing_id'] ,
                    'booking_id' => $validated['booking_id'] ,
                    'image' => null ,
                    'created_on' => date('Y-m-d H:i:s')
                ]);
            }
            return response()->json([
                'status' => 200,
                'messege' => 'Chat created successfully'
            ]);
        }else{
            return $validated->errors();
        }
    }

    public function get_chat(Request $request){
        $validated = $request->validate([
            'booking_id' => 'required'
        ]);

        if($validated){
            $all_chats = [];
          $chat = Chat::where('booking_id', $request->query('booking_id'))
            ->with('user')->with('user.avatars')
            ->with('lister')->with('lister.avatars')
            ->with('listing')
            ->with('booking')
            ->orderBy('created_at', 'DESC')
            ->chunk(100, function($chats) use(&$all_chats){
                foreach ($chats as $key => $value) {
                    $all_chats[] = $value;
                }
            });

            if(count($all_chats)>0){
                return response()->json([
                    'status' => 200,
                    'chats' => $all_chats
                ]);
            }else{
                return response()->json([
                    'status' => 404,
                    'messege' => 'No chats found'
                ], 404);
            }
        }else{
            return $validated->errors();
        }
    }

    public function mark_read(Request $request){
        $validated = $request->validate([
            'user_id' => 'required',
            'booking_id' => 'required'
        ]);

        if($validated){
            Chat::where('user_id', $validated['user_id'])->where('booking_id', $validated['booking_id'])->update([
                'isRead' => true
            ]);

            return response()->json([
                'status' => 200,
                'messege' => 'Chat marked read'
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
            $unread_count = Chat::where('user_id', $request->query('user_id'))->where('isRead', false)->count();
            return response()->json([
                'status' => 200,
                'unread_chat_count' => $unread_count
            ]);
        }else{
            $validated->errors();
        }
    }
}
