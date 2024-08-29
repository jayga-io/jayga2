<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reviews;

class ListingReviewsController extends Controller
{
    public function show_reviews(Request $request){
        $reviews = Reviews::with('user')->with('user_avatar')->with('listing')->get();
        return view('admin.listings.reviews.reviews')->with('reviews', $reviews);
    }

    public function delete_reviews(Request $request, $id){
        Reviews::where('review_id', $id)->delete();
        return redirect()->back()->with('success', 'Review deleted');
    }
}
