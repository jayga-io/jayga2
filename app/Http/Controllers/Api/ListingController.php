<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Listing;
use App\Models\UserNid;
use App\Models\ListerNid;
use App\Models\ListingGuestAmenities;
use App\Models\ListingDescribe;
use App\Models\ListingRestrictions;
use App\Models\ListingImages;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Support\Facades\Storage;

class ListingController extends Controller
{
    public function listings(Request $request){
        $listing = Listing::where('isApproved', true)->with('images')->get();
        if(count($listing)>0){
            return response()->json([
                'status' => 200,
                'Listings' => $listing
            ]);
        }else{
            return response()->json([
                'status' => 404,
                'messege' => 'No Listing found'
            ], 404);
        }
    }

    public function filter(Request $request){
        $filtered_listing = QueryBuilder::for(Listing::class)->where('isApproved', true)->allowedFilters(['guest_num', 'bed_num', 'district', 'town', 'allow_short_stay', 'listing_type'])->with('images')->with('amenities')->with('restrictions')->get();
        if(count($filtered_listing)>0){
            return response()->json([
                'status' => 200,
                'filtered_listing' => $filtered_listing
            ]);
        }else{
            return response()->json([
                'status' => 404,
                'messege' => 'No filter result found'
            ],404);
        }
    }

    public function nid(Request $request){
        $file = $request->file('nid_picture');
        $validated = $request->validate([
            'user_id' => 'required',
            'nid_picture' => 'required'
        ]);
        if($validated){
            if(count($file)>0){
                
                foreach ($file as $f) {
                $path = $f->store('nids');
                UserNid::create([
                    'user_id' => $request->input('user_id'),
                    'user_nid_filename' => $f->hashName(),
                    'user_nid_targetlocation' => $path,
                ]);
                }
                return response()->json([
                    'status' => 200,
                    'messege' => 'Nid Picture uploaded'
                ]);
            }else{
                return response()->json([
                    'status' => 404,
                    'messege' => 'No picture uploaded'
                ], 404);
            } 
        }else{
            return $validated->errors();
        }
        
    }

    public function create(Request $request){

        $validated = $request->validate([
            'lister_id' => 'required'
        ]);

        $check = Listing::where('listing_title', $request->input('listing_title'))->get();
        if(count($check)>0){
            return response()->json([
                'status' => false,
                'messege' => 'Listing title can not be same'
            ]);
        }else{

            if($validated){
                 Listing::create([
                    'lister_id' => $request->input('user_id'),
                    'lister_name' => $request->input('lister_name'),
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
                

                

                return response()->json([
                    'status' => true,
                    'messege' => 'Listing created and submitted for review',
                    'listing_id' => [
                        'id' => $listing_id[0]->listing_id
                    ]
                 ]);
            }else{
                return $validated->errors();
            }
               
        }
                  
        


        
    }

    public function images(Request $request){
        $file = $request->file('listing_pictures');
        $validated = $request->validate([
            'listing_id' => 'required',
            'lister_id' => 'required',
            
        ]);
        if($validated){
            
            if(count($file)>0){
                
                foreach ($file as $f) {
                $path = $f->store('listings');
                ListingImages::create([
                    'listing_id' => $request->input('listing_id'),
                    'lister_id' => $request->input('lister_id'),
                    'listing_filename' => $f->hashName(),
                    'listing_targetlocation' => $path,
                ]);
                }
                return response()->json([
                    'status' => 200,
                    'messege' => 'Listing Pictures uploaded'
                ]);
            }else{
                return response()->json([
                    'status' => 404,
                    'messege' => 'No picture uploaded'
                ], 404);
            } 
        }else{
            return $validated->errors();
        }
    }

    public function listing_nid(Request $request){
        $file = $request->file('listing_nid');
        $validated = $request->validate([
            'listing_id' => 'required',
            'user_id' => 'required',
            
        ]);
        if($validated){
            
            if(count($file)>0){
                
                foreach ($file as $f) {
                $path = $f->store('listings-nid');
                ListerNid::create([
                    'listing_id' => $request->input('listing_id'),
                    'lister_id' => $request->input('user_id'),
                    'nid_filename' => $f->hashName(),
                    'nid_targetlocation' => $path,
                ]);
                }
                return response()->json([
                    'status' => 200,
                    'messege' => 'Listing Nid uploaded'
                ]);
            }else{
                return response()->json([
                    'status' => 404,
                    'messege' => 'No picture uploaded'
                ], 404);
            } 
        }else{
            return $validated->errors();
        }
    }

    public function profile_listings(Request $request, $id){
        $listings = Listing::where('lister_id', $id)->with('amenities')->with('describes')->with('restrictions')->get();
        if(count($listings)>0){
            return response()->json([
                'status' => 200,
                'profile_listings' => $listings
            ]);
        }else{
            return response()->json([
                'status' => 200,
                'messege' => 'No Listings Found'
            ]);
        }
    }

    public function update_listing(Request $request){
        Listing::where('listing_id', $request->input('listing_id'))->update([
            'lister_id' => $request->input('user_id'),
            'lister_name' => $request->input('lister_name'),
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

        ListingDescribe::where('listing_id', $request->input('listing_id'))->update([
            
            'apartments' => $request->input('apartments'),
            'cabin' => $request->input('cabin'),
            'lounge' => $request->input('lounge'),
            'farm' => $request->input('farm'),
            'campsite' => $request->input('campsite'),
            'hotel' => $request->input('hotel'),
            'bread_breakfast' => $request->input('bread_breakfast'),
        ]);

        ListingGuestAmenities::where('listing_id', $request->input('listing_id'))->update([
            
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

        ListingRestrictions::where('listing_id', $request->input('listing_id'))->update([
            
            'indoor_smoking' => $request->input('indoor_smoking'),
            'party' => $request->input('party'),
            'pets' => $request->input('pets'),
            'late_night_entry' => $request->input('late_night_entry'),
            'unknown_guest_entry' => $request->input('unknown_guest_entry'),
            'specific_requirement' => $request->input('specific_requirement'),
            
        ]);

        return response()->json([
            'status' => 200,
            'messege' => 'Listing updated'
        ]);
    }

    public function delete_image_listing(Request $request, $id){
        $img = ListingImages::where('listing_img_id', $id)->get();
        if(count($img)>0){
            Storage::delete($img[0]->listing_targetlocation);
            ListingImages::where('listing_img_id', $id)->delete();
            return response()->json([
                'status' => 200,
                'messege' => 'Listing image deleted'
            ]);
        }else{
            return response()->json([
                'status' => 200,
                'messege' => 'No image found'
            ]);
        }
        
    }

    public function get_listing_images(Request $request, $id){
       $images = ListingImages::where('listing_id', $id)->get();
        if(count($images)>0){
            return response()->json([
                'status' => 200,
                'listing_images' => $images
            ]);
        }else{
            return response()->json([
                'status' => 200,
                'messege' => 'No listing image found'
            ]);
        }
    }
}
