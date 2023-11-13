<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Listing;
use App\Models\ListingGuestAmenities;
use App\Models\ListingImages;
use App\Models\ListingDescribe;
use App\Models\ListingRestrictions;
use App\Models\ListerNid;
use App\Models\UserPictures;


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


    //forms part
    public function user_create(Request $request){
        $phone = $request->session()->get('phone');
      
        User::where('phone', $phone)->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
        ]);

        return redirect(route('step2'));
    }


    public function create_listing(Request $request){
        $ph = $request->session()->get('phone');
        $user = User::where('phone', $ph)->get();
        if(count($user)>0){
            Listing::create([
                'lister_id' => $user[0]->id,
                'lister_name' => $user[0]->name,
                'listing_title' => $request->input('listing_title'),
                'listing_description' => $request->input('listing_description'),
                'describe_peaceful' => $request->input('peaceful'),
                'describe_familyfriendly' => $request->input('describe_familyfriendly'),
                'door_lock' => $request->input('door_lock'),
                'listing_type' => $request->input('listing_type'),
            ]);
            session([ 
                'listing_title' => $request->input('listing_title')
            ]);
            return redirect(route('step4'));
        }else{
            return redirect(route('step3'));
        }
    }

    public function create_infos(Request $request){
        $ph = $request->session()->get('phone');
        $user = User::where('phone', $ph)->get();
        $title = $request->session()->get('listing_title');
        $listing = Listing::where('listing_title', $title)->get();
        if(count($listing)>0){
            Listing::where('listing_id', $listing[0]->listing_id)->update([
                'guest_num' => $request->input('guest_num'),
                'bed_num' => $request->input('bed_num'),
                'bathroom_num' => $request->input('bathroom_num'),
                'allow_short_stay' => $request->input('allow_short_stay')
            ]);
            return redirect(route('step5'));
        }else{
            return redirect(route('step4'));
        }
    }

    public function doc_uploads(Request $request){
        
        $ph = $request->session()->get('phone');
        $user = User::where('phone', $ph)->get();
        $title = $request->session()->get('listing_title');
        $listing = Listing::where('listing_title', $title)->get();

        if(count($listing)>0){
           
           
            $nid = $request->file('nid');
            $utility = $request->file('utility');
                foreach ($nid as $value) {
                $path = $value->store('listings-nid');
                    ListerNid::create([
                        'listing_id' => $listing[0]->listing_id,
                        'lister_id' => $user[0]->id,
                        'nid_filename' => $value->hashName(),
                        'nid_targetlocation' => $path,
                    ]);
            }

            foreach ($utility as $item) {
                $road = $item->store('user_files');
                UserPictures::updateOrCreate([
                    'user_id' => $user[0]->id,
                    'user_filename' => $item->hashName(),
                    'user_targetlocation' => $road,
                ]);
            }

            return redirect(route('step6'));
        }else{
            return redirect(route('step5'));
        }
       
    }

    public function create_amenities(Request $request){
        $title = $request->session()->get('listing_title');
        $listing = Listing::where('listing_title', $title)->get();
        if(count($listing)>0){
             ListingGuestAmenities::create([
            'listing_id' => $listing[0]->listing_id,
            'wifi' => $request->input('wifi'),
            'tv' => $request->input('tv'),
            'kitchen' => $request->input('kitchen'),
            'washing_machine' => $request->input('washing_machine'),
            'free_parking' => $request->input('free_parking'),
            'breakfast_included' => $request->input('breakfast_included'),
            'air_condition' => $request->input('air_condition'),
            'dedicated_workspace' => $request->input('dedicated_workspace'),
            
            'gym' => $request->input('gym'),
            'beach_lake_access' => $request->input('beach_lake_access'),
            
            'fire_extinguish' => $request->input('fire_extinguish'),
            'cctv' => $request->input('cctv'),
        ]);

            return redirect(route('step7'));
        }else{
            return redirect(route('step6'));
        }
       
    }

    public function create_restrictions(Request $request){
        $title = $request->session()->get('listing_title');
        $listing = Listing::where('listing_title', $title)->get();
        if(count($listing)>0){
            ListingRestrictions::create([
                'listing_id' => $listing[0]->listing_id,
                'indoor_smoking' => $request->input('indoor_smoking'),
                'party' => $request->input('party'),
                'pets' => $request->input('pets'),
                'late_night_entry' => $request->input('late_night_entry'),
                'unknown_guest_entry' => $request->input('unknown_guest_entry'),
                
                
            ]);

            return redirect(route('step8'));
        }else{
            return redirect(route('step7'));
        }
       
    }


    public function upload_listing_images(Request $request){
        
        $ph = $request->session()->get('phone');
        $user = User::where('phone', $ph)->get();
        $title = $request->session()->get('listing_title');
        $listing = Listing::where('listing_title', $title)->get();
        if(count($listing)>0){
            $images = $request->file('listingimages');
            foreach ($images as $mal) {
                $path = $mal->store('listings');
                ListingImages::create([
                    'listing_id' => $listing[0]->listing_id,
                    'lister_id' => $user[0]->id,
                    'listing_filename' => $mal->hashName(),
                    'listing_targetlocation' => $path,
                ]);
            }
            return redirect(route('step9'));
        }else{
            return redirect(route('step8'));
        }
        
    }

    public function set_address(Request $request){
        $ph = $request->session()->get('phone');
        $user = User::where('phone', $ph)->get();
        $title = $request->session()->get('listing_title');
        $listing = Listing::where('listing_title', $title)->get();
        if(count($listing)>0){
            Listing::where('listing_id', $listing[0]->listing_id)->update([
                'listing_address' => $request->input('street_address'),
                'district' => $request->input('city'),
                'town' => $request->input('town'),
                'zip_code' => $request->input('zip'),
                'full_day_price_set_by_user' => $request->input('price')
            ]);
            return redirect(route('step10'));
        }else{
            return redirect(route('step9'));
        }
    }


}
