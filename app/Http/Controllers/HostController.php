<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HostController extends Controller
{
    public function userform(){
        return view('host.setup.forms.userform');
    }

    public function hostypeform(){
        return view('host.setup.forms.hosting-type-form');
    }

    public function listingform(){
        return view('host.setup.forms.listingform');
    }

    public function listing_nid(){
        return view('host.setup.forms.listing-nid');
    }

    public function listing_images(){
        return view('host.setup.forms.listingimages');

    }

    public function amenities(){
        return view('host.setup.forms.amenities');
    }

    public function restrictions(){
        return view('host.setup.forms.restrictions');
    }

    public function listing_info(){
        return view('host.setup.forms.listinginfo');
    }

    public function set_home_address(){
        return view('host.setup.forms.set-home-address');
    }

    public function congrats(){
        return view('host.setup.forms.congrats');
    }
}
