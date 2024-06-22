<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Feedback;

class FeedbackController extends Controller
{
    public function create(Request $request){
        $validated = $request->validate([
            'user_id' => 'required'
        ]);

        if($validated){
            Feedback::create([
                'user_id' => $request->input('user_id'),
                'title' => $request->input('title'),
                'note' => $request->input('note'),
                'type' => 'app',
            ]);

            return response()->json([
                'status' => 200,
                'messege' => 'Feedback sent successfully'
            ]);
        }else{
            return $validated->errors();
        }
    }

    public function feedback_web(Request $request){
        $validated = $request->validate([
            'email' => 'required',
        ]);
        if($validated){
            
            Feedback::create([
                'email' => $request->input('email'),
                'title' => 'web feedback',
                'note' => $request->input('messege'),
                'type' => 'web'
            ]);
        }else{
            return $validated->errors();
        }
    }
}
