<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\Listing;
use App\Models\ListingDescribe;
use App\Models\ListingGuestAmenities;
use App\Models\ListingRestrictions;
use App\Models\ListingImages;
use App\Models\ListerNid;
use App\Models\User;
use App\Models\UserPictures;
use App\Http\Requests\StoreListingRequest;
use App\Http\Requests\UpdateListingRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Storage;

class ListingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::whereNotNull('name')->get();
        $locations = \File::json('locations.json');
 
        return view('admin.add-listing')->with('users', $user)->with('locations', $locations);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
      if($request->method() == 'POST'){
       // dd($request->all());
       $lister = $request->input('lister_id');
       
       if($lister === null){
        return redirect()->back()->with('errors', 'No Lister found');
       }else{
        $lister = explode(',', $lister);
        $lister_name = $lister[1];
        $lister_id = $lister[0];
        $images = [];
        //check 
        $check = Listing::where('listing_title', $request->input('listing_title'))->get();
        if(count($check)>0){
            return response()->json([
                'status' => 200,
                'messege' => 'Listing title can not be same'
            ]);
        }else{

            Listing::create([
                'lister_id' => $lister_id,
                'lister_name' => $lister_name,
                'guest_num' => $request->input('guest_num'),
                'bed_num' => $request->input('bed_num'),
                'bathroom_num' => $request->input('bathroom_num'),
                'listing_title' => $request->input('listing_title'),
                'listing_description' => $request->input('listing_description'),
                'full_day_price_set_by_user' => $request->input('full_day_price_set_by_user'),
                'listing_address' => $request->input('listing_address'),
                'zip_code' => $request->input('zip_code'),
                'district' => $request->input('district'),
                'town' => $request->input('town'),
                
                'allow_short_stay' => $request->input('allow_short_stay'),
                'describe_peaceful' => $request->input('describe_peaceful'),
                'describe_unique' => $request->input('describe_unique'),
                'describe_familyfriendly' => $request->input('describe_familyfriendly'),
                'describe_stylish' => $request->input('describe_stylish'),
                'describe_central' => $request->input('describe_central'),
                'describe_spacious' => $request->input('describe_spacious'),
                'lat' => $request->input('lati'),
                'long' => $request->input('longi'),
                'listing_type' => $request->input('listing_type'),
            ]);

            
            $listing_id = Listing::where('listing_title', $request->input('listing_title'))->get();

            
                
                ListingDescribe::create([
                    'listing_id' => $listing_id[0]->listing_id,
                    'apartments' => $request->input('apartments'),
                    'cabin' => $request->input('cabin'),
                    'lounge' => $request->input('lounge'),
                    'farm' => $request->input('farm'),
                    'campsite' => $request->input('campsite'),
                    'hotel' => $request->input('hotel'),
                    'bread_breakfast' => $request->input('bread_breakfast'),
                ]);

                ListingGuestAmenities::create([
                    'listing_id' => $listing_id[0]->listing_id,
                    'wifi' => $request->input('wifi'),
                    'tv' => $request->input('tv'),
                    'kitchen' => $request->input('kitchen'),
                    'washing_machine' => $request->input('washing_machine'),
                    'free_parking' => $request->input('free_parking'),
                    'breakfast_included' => $request->input('breakfast_included'),
                    'air_condition' => $request->input('air_condition'),
                    'dedicated_workspace' => $request->input('dedicated_workspace'),
                    'pool' => $request->input('pool'),
                    'hot_tub' => $request->input('hot_tub'),
                    'patio' => $request->input('patio'),
                    'bbq_grill' => $request->input('bbq_grill'),
                    'outdooring' => $request->input('outdooring'),
                    'fire_pit' => $request->input('fire_pit'),
                    'gym' => $request->input('gym'),
                    'beach_lake_access' => $request->input('beach_lake_access'),
                    'smoke_alarm' => $request->input('smoke_alarm'),
                    'first_aid' => $request->input('first_aid'),
                    'fire_extinguish' => $request->input('fire_extinguish'),
                    'cctv' => $request->input('cctv'),
                ]);

                ListingRestrictions::create([
                    'listing_id' => $listing_id[0]->listing_id,
                    'indoor_smoking' => $request->input('indoor_smoking'),
                    'party' => $request->input('party'),
                    'pets' => $request->input('pets'),
                    'late_night_entry' => $request->input('late_night_entry'),
                    'unknown_guest_entry' => $request->input('unknown_guest_entry'),
                    'specific_requirement' => $request->input('specific_requirement'),
                    
                ]);
            
                
                if($files = $request->file('listing_pictures')){
                
                    foreach ($files as $f) {
                    $path = $f->store('listings');
                    ListingImages::create([
                        'listing_id' => $listing_id[0]->listing_id,
                        'lister_id' => $lister_id,
                        'listing_filename' => $f->hashName(),
                        'listing_targetlocation' => $path,
                    ]);
                    }
                   
                }
                
                    
                 return redirect(route('addlisting'))->with('success', 'Listing Created and Submitted for review');
                    
                        
            }
            
        }

        
                return view('admin.dashboard');
        } 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreListingRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, $id)
    {
 
        $listingImages = ListingImages::where('listing_id', $id)->get();
        $amenities = ListingGuestAmenities::where('listing_id', $id)->get();
        $restrictions = ListingRestrictions::where('listing_id', $id)->get();
        $describes = ListingDescribe::where('listing_id', $id)->get();
        $listing = Listing::where('listing_id', $id)->get();
        $lister = User::where('id', $listing[0]->lister_id)->get();
        $lister_image = UserPictures::where('user_id', $listing[0]->lister_id)->get();
        $lister_nid = ListerNid::where('listing_id', $id)->get();
       
        return view('admin.view-listing')
        ->with('listing_images', $listingImages)->with('listing', $listing)->with('lister', $lister)
        ->with('lister_image', $lister_image)->with('describes', $describes)->with('restrictions', $restrictions)
        ->with('amenities', $amenities)->with('lister_nid', $lister_nid);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Listing $listing)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateListingRequest $request, Listing $listing)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Listing $listing, $id)
    {
        
        $images = ListingImages::where('listing_id', $id)->get();
        $nids = ListerNid::where('listing_id', $id)->get();
        foreach ($images as $value) {
           Storage::delete($value->listing_targetlocation);
        }

        foreach ($nids as $value) {
            Storage::delete($value->nid_targetlocation);
        }
        

        $lister_id = Listing::where('listing_id', $id)->get();
        $user = User::where('id', $lister_id[0]->lister_id)->get();

        $url = 'https://sysadmin.muthobarta.com/api/v1/send-sms';
            
        
        $phone = $user[0]->phone;
        $data = [
            "sender_id" => "8809601010510",
            "receiver" => $phone,
            "message" => 'Your listing : '. $lister_id[0]->listing_title . 'has been declined',
            "remove_duplicate" => true
        ];
        $response = Http::withHeaders([
            'Authorization' => 'Token d275d614a4ca92e21d2dea7a1e2bb81fbfac1eb0',
            
        ])->post($url, $data);

        Listing::where('listing_id', $id)->delete();

        return redirect(route('pendinglisting'))->with('deleted', 'Listing Declined');
    }

    public function approve(Request $request, $id){
        Listing::where('listing_id', $id)->update([
            'isApproved' => true
        ]);

        $lister_id = Listing::where('listing_id', $id)->get();
        $user = User::where('id', $lister_id[0]->lister_id)->get();

        $url = 'https://sysadmin.muthobarta.com/api/v1/send-sms';
            
        
        $phone = $user[0]->phone;
        $data = [
            "sender_id" => "8809601010510",
            "receiver" => $phone,
            "message" => 'Your listing : '. $lister_id[0]->listing_title . 'has been approved',
            "remove_duplicate" => true
        ];
        $response = Http::withHeaders([
            'Authorization' => 'Token d275d614a4ca92e21d2dea7a1e2bb81fbfac1eb0',
            
        ])->post($url, $data);
        return redirect(route('pendinglisting'))->with('success', 'Listing Approved');
    }

    public function delete(Request $request, $id){
        $images = ListingImages::where('listing_id', $id)->get();
        $nids = ListerNid::where('listing_id', $id)->get();
        foreach ($images as $value) {
           Storage::delete($value->listing_targetlocation);
        }

        foreach ($nids as $value) {
            Storage::delete($value->nid_targetlocation);
        }

        Listing::where('listing_id', $id)->delete();
        return redirect()->back()->with('deleted', 'Listing Deleted');
    }

   
}
