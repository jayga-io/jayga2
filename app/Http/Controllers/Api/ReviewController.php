<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reviews;
use App\Models\User;

class ReviewController extends Controller
{
    public function create(Request $request){
        $validated = $request->validate([
            'user_id' => 'required',
            'listing_id' => 'required',
            'lister_id' => 'required',
            'stars' => 'required',
            'review' => 'required',
        ]);

        if($validated){
            $user = User::where('id', $request->input('user_id'))->get();
            Reviews::create([
                'user_id' => $request->input('user_id'),
                'user_name' => $user[0]->name,
                'listing_id' => $request->input('listing_id'),
                'lister_id' => $request->input('lister_id'),
                'stars' => $request->input('stars'),
                'description' => $request->input('review'),
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
       $reviews = Reviews::where('listing_id', $id)->get();
        if(count($reviews)>0){
            $total = 0;
            foreach ($reviews as $value) {
                $total = $total + $value->stars ;
            }
            $avg = $total / count($reviews);

            return response()->json([
                'status' => 200,
                'average_rating' => $avg,
                'reviews' => $reviews
            ]);
        }else{
            return response()->json([
                'status' => 200,
                'messege' => 'No reviews found'
            ]);
        }
    }
}
