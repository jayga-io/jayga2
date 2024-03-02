<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FavListing;

class FavouritesController extends Controller
{
    public function show_favs(Request $request){
        $user = $request->session()->get('user');
       $favs = FavListing::where('user_id', $user)->with('listing')->with('listing_image')->orderBy('created_at', 'DESC')->get();

        return view('client.favouritelistings.favourites')->with('favs', $favs);
    }

    public function remove(Request $request, $id){
        FavListing::where('id', $id)->delete();

        return redirect(route('showfavs'))->with('messege', 'Favourite listing removed');
    }
}
