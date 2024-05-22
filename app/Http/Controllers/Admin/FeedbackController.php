<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Feedback;

class FeedbackController extends Controller
{
    public function show(Request $request){
        $feedback = Feedback::with('users')->get();
        return view('admin.feedbacks.feedback')->with('user', $feedback);
    }
}
