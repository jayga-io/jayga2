<?php

namespace App\Http\Controllers\Host;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Listing;
use App\Models\ListingGuestAmenities;
use App\Models\ListingImages;
use App\Models\ListingDescribe;
use App\Models\ListingRestrictions;
use App\Models\ListerNid;
use App\Models\UserPictures;
use Image;


class HostController extends Controller
{
    public function userform(){
       return redirect(route('step2'));
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


    //edit part

    public function edit_listing(Request $request){
        
        return view('host.setup.forms.editforms.edit-listing');
    }

    public function edit_infos(Request $request){
        return view('host.setup.forms.editforms.infos');
    }

    public function edit_amenities(Request $request){
        return view('host.setup.forms.editforms.amenities');
    }

    public function edit_restrictions(Request $request){
        return view('host.setup.forms.editforms.restrictions');
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
        $listing = Listing::where('listing_title', $request->input('listing_title'))->where('lister_id', $request->session()->get('user'))->get();
        if(count($listing) == 0){
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

            $id = Listing::where('listing_title', $request->input('listing_title'))->where('lister_id', $request->session()->get('user'))->get();
            
            session([ 
                'listing_id' => $id[0]->listing_id,
                'listing_title' => $request->input('listing_title'),
                'listing_description' => $request->input('listing_description'),
                'describe_peaceful' => $request->input('peaceful'),
                'describe_familyfriendly' => $request->input('describe_familyfriendly'),
                'door_lock' => $request->input('door_lock'),
                'listing_type' => $request->input('listing_type'),
            ]);
            return redirect(route('step4'));
        }else{
            toastr()->persistent()->closeButton()->preventDuplicates(true)->addWarning('Listing title must be different');
            return redirect(route('step3'));
        }
    }


    public function create_infos(Request $request){
      
        $title = $request->session()->get('listing_title');
        $listing = Listing::where('listing_title', $title)->get();
        
        if(count($listing)>0){
            Listing::where('listing_id', $listing[0]->listing_id)->update([
                'guest_num' => $request->input('guest_num'),
                'bed_num' => $request->input('bed_num'),
                'bathroom_num' => $request->input('bathroom_num'),
                'allow_short_stay' => $request->input('allow_short_stay')
            ]);
            session([
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
            $nid2= $request->file('nid2');
            $utility = $request->file('utility');
            if($nid){
                foreach ($nid as $value) {
                $path = $value->store('listings-nid');
                    ListerNid::create([
                        'listing_id' => $listing[0]->listing_id,
                        'lister_id' => $user[0]->id,
                        'nid_filename' => $value->hashName(),
                        'nid_targetlocation' => $path,
                    ]);
            }
            }
                
            if($nid2){
                foreach ($nid2 as $identity) {
                $path2 = $identity->store('listings-nid');
                ListerNid::create([
                    'listing_id' => $listing[0]->listing_id,
                    'lister_id' => $user[0]->id,
                    'nid_filename' => $identity->hashName(),
                    'nid_targetlocation' => $path2,
                ]);
            }
            }
            
            if($utility){
                 foreach ($utility as $item) {
                $road = $item->store('user_files');
                UserPictures::updateOrCreate([
                    'user_id' => $user[0]->id,
                    'user_filename' => $item->hashName(),
                    'user_targetlocation' => $road,
                ]);
            }
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

        session([
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

            session([
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
            if($images){
                foreach ($images as $mal) {
                
                $path = $mal->store('listings');
               // $img = Image::make($path)->resize(700,500)->save($path);
                ListingImages::create([
                    'listing_id' => $listing[0]->listing_id,
                    'lister_id' => $user[0]->id,
                    'listing_filename' => $mal->hashName(),
                    'listing_targetlocation' => $path,
                ]);
            }
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







    public function update_listing(Request $request){
       
      
            Listing::where('listing_id', $request->session()->get('listing_id'))->where('lister_id', $request->session()->get('user'))->update([
                
                'listing_title' => $request->input('listing_title'),
                'listing_description' => $request->input('listing_description'),
                'describe_peaceful' => $request->input('peaceful'),
                'describe_familyfriendly' => $request->input('describe_familyfriendly'),
                'door_lock' => $request->input('door_lock'),
                'listing_type' => $request->input('listing_type'),
            ]);

            session([
                'listing_title' => $request->input('listing_title'),
                'listing_description' => $request->input('listing_description'),
                'describe_peaceful' => $request->input('peaceful'),
                'describe_familyfriendly' => $request->input('describe_familyfriendly'),
                'door_lock' => $request->input('door_lock'),
                'listing_type' => $request->input('listing_type'),
            ]);
           
            toastr()->addSuccess('Listing info updated');
            return redirect(route('step4'));
    }

    public function update_infos(Request $request){
        Listing::where('listing_id', $request->session()->get('listing_id'))->update([
            'guest_num' => $request->input('guest_num'),
            'bed_num' => $request->input('bed_num'),
            'bathroom_num' => $request->input('bathroom_num'),
            'allow_short_stay' => $request->input('allow_short_stay')
        ]);
        session([
            'guest_num' => $request->input('guest_num'),
            'bed_num' => $request->input('bed_num'),
            'bathroom_num' => $request->input('bathroom_num'),
            'allow_short_stay' => $request->input('allow_short_stay')
        ]);
        toastr()->addSuccess('Listing info updated');
            return redirect(route('step5'));
    }

    public function update_amenities(Request $request){
        ListingGuestAmenities::where('listing_id', $request->session()->get('listing_id'))->update([
            
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

        session([
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
        toastr()->addSuccess('Listing info updated');
        return redirect(route('step7'));
    }

    public function update_restrictions(Request $request){
        ListingRestrictions::where('listing_id', $request->session()->get('listing_id'))->update([
            
            'indoor_smoking' => $request->input('indoor_smoking'),
            'party' => $request->input('party'),
            'pets' => $request->input('pets'),
            'late_night_entry' => $request->input('late_night_entry'),
            'unknown_guest_entry' => $request->input('unknown_guest_entry'),
            
            
        ]);

        session([
            
            'indoor_smoking' => $request->input('indoor_smoking'),
            'party' => $request->input('party'),
            'pets' => $request->input('pets'),
            'late_night_entry' => $request->input('late_night_entry'),
            'unknown_guest_entry' => $request->input('unknown_guest_entry'),
        ]);

        return redirect(route('step8'));
    }

}
