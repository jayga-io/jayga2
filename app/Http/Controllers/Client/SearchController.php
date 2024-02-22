<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ListingAvailable;
use App\Models\Listing;
use App\Models\Booking;
use Spatie\QueryBuilder\QueryBuilder;

class SearchController extends Controller
{
    public function search(Request $request){
        $category = $request->input('category');
       // $booking = Booking::whereNot('date_enter', $request->input('checkin'))->whereNot('date_exit', $request->input('checkout'))->get();
      // dd($request->all());
       if($category === 'default'){
           // $listing = Listing::where('listing_type', $request->input('options_base'))->orWhere('district', $request->input('city'))->orWhere('guest_num', $request->input('guests'))->with('images')->get();
           // dd($listing);
           $listing = QueryBuilder::for(Listing::class)->where('isApproved', true)
           ->where('isActive', true)
           ->where('listing_type', $request->input('options_base'))
           ->where('district', $request->input('city'))
           ->where('guest_num', $request->input('guests'))
           ->with('images')
           ->with('amenities')
           ->with('restrictions')
           ->with('reviews')
           ->get();
           
           return view('client.search.searchResults')->with('listings', $listing);
        }else{
          //  $listing = Listing::where('listing_type', $request->input('category'))->orWhere('district', $request->input('city'))->orWhere('guest_num', $request->input('guests'))->get();
          //  dd($listing->count());
          $listing = QueryBuilder::for(Listing::class)->where('isApproved', true)
          ->where('isActive', true)
           ->where('listing_type', $request->input('category'))
           ->where('district', $request->input('city'))
           ->where('guest_num', $request->input('guests'))
           ->with('images')
           ->with('amenities')
           ->with('restrictions')
           ->with('reviews')
           ->get();
           
           return view('client.search.searchResults')->with('listings', $listing);
        }
    }
}
