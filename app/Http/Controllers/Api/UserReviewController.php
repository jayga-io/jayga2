<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserReview;

class UserReviewController extends Controller
{
    public function create(Request $request){
        $validated = $request->validate([
            'user_id' => 'required',
            'host_id' => 'required',
            
            'stars' => 'required',
            'messege' => 'string|nullable',
        ]);

        if($validated){
            $user = User::where('id', $validated['user_id'])->get();
            $host = User::where('id', $validated['host_id'])->get();
            UserReview::create([
                'host_id' => $validated['host_id'],
                'user_id' => $validated['user_id'],
                'stars' => $validated['stars'],
                'messeges' => $validated['messege'],
                'created_on' => date('Y-m-d H:i:s')
            ]);
            return response()->json([
                'status' => 200,
                'messege' => 'Review Submitted. Thank you for your feedback'
            ]);
        }else{
            return $validated->errors();
        }
    }

    public function view(Request $request, $id){
       $reviews = UserReview::where('host_id', $id)->orderBy('stars')->get();
        if(count($reviews)>0){
            $total = 0;
            foreach ($reviews as $value) {
                $total = $total + $value->stars ;
            }
            $avg = $total / count($reviews);
            $rounded_avg = number_format((float)$avg, 1, '.', '');
            UserReview::where('host_id', $id)->update([
                'avg_rating' => $rounded_avg
            ]);

            $updated_reviews = UserReview::where('host_id', $id)->orderBy('stars')->with('user.avatars')->get();
            return response()->json([
                'status' => 200,
                
                'reviews' => $updated_reviews
            ]);
        }else{
            return response()->json([
                'status' => 200,
                'messege' => 'No reviews found'
            ]);
        }
    }
}
