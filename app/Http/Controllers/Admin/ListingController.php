<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\Listing;
use App\Models\AmenitiesList;
use App\Models\RestrictionList;
use App\Models\ListingImages;
use App\Models\ListingAmenities;
use App\Models\ListingRestricts;
use App\Models\ListerNid;
use App\Models\User;
use App\Models\UserPictures;
use App\Http\Requests\StoreListingRequest;
use App\Http\Requests\UpdateListingRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Storage;

use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Message;

class ListingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::whereNotNull('name')->get();
        $locations = \File::json('locations.json');
 
        return view('admin.listings.add-listing')->with('users', $user)->with('locations', $locations);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $user = User::where('id', $request->input('user'))->get();
       // dd($request);
       Listing::create([
        'lister_id' => $request->input('user'),
        'lister_name' => $user[0]->name,
        'guest_num' => $request->input('guest_num'),
        'bed_num' => $request->input('bed_num'),
        'bathroom_num' => $request->input('bathroom_num'),
        'listing_title' => $request->input('listing_title'),
        'listing_description' => $request->input('listing_desc'),
        'full_day_price_set_by_user' => $request->input('listing_price'),
        'listing_address' => $request->input('listing_address'),
        'district' => $request->input('district'),
        'zip_code' => $request->input('zip'),
        'allow_short_stay' => $request->input('short_stay'),
        'listing_type' => $request->input('listing_type'),
       ]);

       $listing = Listing::where('listing_title', $request->input('listing_title'))->get();
       return redirect('/admin/add-listing-features/'.$listing[0]->listing_id);
    }

    public function pending_listings(Request $request){
        $listings = Listing::where('isActive', true)->where('isApproved', false)->orderBy('created_at', 'DESC')->get();
        return view('admin.listings.pending-listing')->with('pending', $listings);
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
       // $amenities = ListingGuestAmenities::where('listing_id', $id)->get();
       // $restrictions = ListingRestrictions::where('listing_id', $id)->get();
       // $describes = ListingDescribe::where('listing_id', $id)->get();
        $listing = Listing::where('listing_id', $id)->get();
        $lister = User::where('id', $listing[0]->lister_id)->get();
        $lister_image = UserPictures::where('user_id', $listing[0]->lister_id)->get();
        $lister_nid = ListerNid::where('listing_id', $id)->get();
       
        return view('admin.listings.view-listing')
        ->with('listing_images', $listingImages)->with('listing', $listing)->with('lister', $lister)
        ->with('lister_image', $lister_image)->with('lister_nid', $lister_nid);
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


    public function add_features(Request $request, $id){
        $listing_id = $id;
        $amenities = AmenitiesList::all();
        $restrictions = RestrictionList::all();
        return view('admin.listings.add-amenities')->with('amenities', $amenities)->with('restrictions', $restrictions)->with('listing_id', $listing_id);
    }

    public function store_features(Request $request){
        //dd($request->all());
        if($request->input('amenities') != null || $request->input('restrictions') != null){
            $amn = $request->input('amenities');
            $restrct = $request->input('restrictions');
            foreach ($amn as $key => $value) {
                ListingAmenities::create([
                    'listing_id' => $request->input('listing_id'),
                    'amenities_id' => $value,
                ]);
            }

            foreach ($restrct as $key => $value) {
                ListingRestricts::create([
                    'listing_id' => $request->input('listing_id'),
                    'restriction_id' => $value,
                ]);
            }

            return view('admin.listings.add-images')->with('listing_id', $request->input('listing_id'));
        }else{
            return redirect()->back()->with('errors', 'Please add some features');
        }
    }


    public function save_listing(Request $request){
        $listing_id = $request->input('listing_id');
      
        if($request->hasFile('listing_images')){
            $images[] = $request->file('listing_images');
           // dd($images);
            $lister_id = Listing::where('listing_id', $listing_id)->get();
             foreach ($images[0] as $value) {
              $path = $value->store('listings');
                ListingImages::create([
                    'listing_id' => $listing_id,
                    'lister_id' => $lister_id[0]->lister_id,
                    'listing_filename' => $value->hashName(),
                    'listing_targetlocation' => $path
                ]);
            }
            return redirect('/admin')->with('success', 'Listing created & assigned to user.');
        }else{
            return redirect('/admin')->with('error', 'Listing images can not be created');
        }
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
            "message" => 'Dear user, your request for new listing : '. $lister_id[0]->listing_title . ' has been declined by Jayga',
            "remove_duplicate" => true
        ];
        send_sms($data);

       // Listing::where('listing_id', $id)->delete();

        $notifys = [
            'user_id' => $user[0]->id,
            'lister_id' => $lister_id[0]->lister_id,
            'listing_id' => $id,
            'type' => 'Listing',
            'messege' => 'Your listing : '. $lister_id[0]->listing_title . ' has been declined'
           ];
    
           notify($notifys);

           $notif_details = [
            'token' => $user[0]->FCM_token,
            'title' => 'Listing ['.$lister_id[0]->listing_title.'] declined',
            'body' => 'Your listing ['.$lister_id[0]->listing_title.'] has been declined'
           ];
          // dd($notif_data);
           send_notif($notif_details);

           /*
           $receipent = $user[0]->email;
            $subject = 'Listing declined';

            Mail::plain(
                 view: 'mailTemplates.listingdecline',
                    data: [
                            'user' => $user[0]->name,
                           
                            
                        ],
                    callback: function (Message $message) use ($receipent, $subject) {
                            $message->to($receipent)->subject($subject);
                        }
                    ); */
            
            Listing::where('listing_id', $id)->delete();
            
        return redirect(route('pendinglisting'))->with('deleted', 'Listing Declined');
    }

    public function approve(Request $request, $id){

        $checkimg = ListingImages::where('listing_id', $id)->get();
       // dd($checkimg)
        if(count($checkimg) == 0){
            return redirect()->back()->with('error', 'Listing has no image.');
        }else{
            Listing::where('listing_id', $id)->update([
                        'isApproved' => true
                    ]);

                    $lister_id = Listing::where('listing_id', $id)->get();
                    $user = User::where('id', $lister_id[0]->lister_id)->get();

                    $phone = $user[0]->phone;
                    $data = [
                        "sender_id" => "8809601010510",
                        "receiver" => $phone,
                        "message" => 'Dear user, your request for new listing : '. $lister_id[0]->listing_title . 'with jayga has been approved',
                        "remove_duplicate" => true
                    ];
                    
                    send_sms($data);

                    

                $notifys = [
                    'user_id' => $user[0]->id,
                    'lister_id' => $lister_id[0]->lister_id,
                    'listing_id' => $id,
                    'type' => 'Listing',
                    'messege' => 'Your listing : '. $lister_id[0]->listing_title . ' has been approved',
                    'created_on' => date('Y-m-d H:i:s')
                ];

                notify($notifys);

                /*
                $receipent = $user[0]->email;
                $subject = 'Listing approved';

                    Mail::plain(
                        view: 'mailTemplates.listingapprove',
                        data: [
                            'user' => $user[0]->name,
                            'listing_title' => $lister_id[0]->listing_title,
                            
                        ],
                        callback: function (Message $message) use ($receipent, $subject) {
                            $message->to($receipent)->subject($subject);
                        }
                    ); */
                    $notif_details = [
                        'token' => $user[0]->FCM_token,
                        'title' => 'Listing ['.$lister_id[0]->listing_title.'] approved',
                        'body' => 'Your listing ['.$lister_id[0]->listing_title.'] has been approved',
                       ];
                      // dd($notif_data);
                       send_notif($notif_details);

                return redirect(route('pendinglisting'))->with('success', 'Listing Approved');
        }

        

        
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

    public function enable(Request $request, $id){
        $ls = Listing::where('listing_id', $id)->get();
        $notifys = [
            'user_id' => $ls[0]->lister_id,
            'lister_id' => $ls[0]->lister_id,
            'listing_id' => $id,
            
            'type' => 'Listing',
            'messege' => 'Your Listing : '. $ls[0]->listing_title . ' has been enabled'
           ];

           notify($notifys);
        Listing::where('listing_id', $id)->update([
            'isApproved' => true,
            'isActive' => true,
        ]);

        return redirect()->back()->with('success', 'Listing Enabled');
    }


    public function disable(Request $request, $id){
        $ls = Listing::where('listing_id', $id)->with('booking')->get();
        $notifys = [
            'user_id' => $ls[0]->lister_id,
            'lister_id' => $ls[0]->lister_id,
            'listing_id' => $id,
            
            'type' => 'Listing',
            'messege' => 'Your Listing : '. $ls[0]->listing_title . ' has been disabled'
           ];

           notify($notifys);

           $lister = User::where('id', $ls[0]->lister_id)->get();

           $notif_details = [
            'token' => $lister[0]->FCM_token,
            'title' => 'Your listing has been disabled',
            'body' => 'Open the app to proceed'
           ];
          // dd($notif_data);
           send_notif($notif_details);


        Listing::where('listing_id', $id)->update([
            'isApproved' => false,
            'isActive' => false,
        ]);

        return redirect()->back()->with('errors', 'Listing disabled');
    }

    public function disabled_listings(Request $request){
        $disabled_listings = Listing::where('isApproved', false)->where('isActive', false)->get();
        return view('admin.listings.disabled-listings')->with('disabled_listings', $disabled_listings);
    }

    public function all_listings(Request $request){
        $listings = Listing::orderBy('created_at', 'DESC')->get();
        return view('admin.listings.all-listings')->with('all', $listings);
    }

   
}
