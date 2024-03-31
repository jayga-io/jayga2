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
use App\Models\FavListing;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;

class ListingController extends Controller
{
    public function listings(Request $request){
        $listing = Listing::where('isApproved', true)->where('isActive', true)->with('newAmenities.amenity')->with('newRestrictions.restrictions')->with('images')->get();
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
        $filtered_listing = QueryBuilder::for(Listing::class)->where('isApproved', true)->where('isActive', true)->allowedFilters(['guest_num', 'bed_num', 'district', 'town', 'allow_short_stay', 'listing_type'])->with('images')->with('newAmenities.amenity')->with('newRestrictions.restrictions')->with('reviews')->get();
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

    

    public function create(Request $request){

        $validated = $request->validate([
            'user_id' => 'required'
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
                    
                    'lat' => $request->input('lati'),
                    'long' => $request->input('longi'),
                    'listing_type' => $request->input('listing_type'),
                    'video_link' => $request->input('video_link'),
                ]);

                
        
                $listing_id = Listing::where('listing_title', $request->input('listing_title'))->get();
              //  dd($check[0]);
                

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
        $listings = Listing::where('lister_id', $id)->with('newAmenities.amenity')->with('newRestrictions.restrictions')->with('images')->get();
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
            'video_link' => $request->input('video_link'),
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
            'room_service' => $request->input('room_service'),
            'pet_friendly' => $request->input('pet_friendly'),
            'airport_shuttle' => $request->input('airport_shuttle'),
            'fitness_center' => $request->input('fitness_center'),
            'spa' => $request->input('spa'),
            'business_center' => $request->input('business_center'),
            'bar/lounge' => $request->input('bar/lounge'),
            'consierge_services' => $request->input('consierge_services'),
            'laundry_service' => $request->input('laundry_service'),
            'meeting_rooms' => $request->input('meeting_rooms'),
            'outdoor_pool' => $request->input('outdoor_pool'),
            'restaurant' => $request->input('restaurant'),
            'smoke_free_property' => $request->input('smoke_free_property'),
            'kid_friendly' => $request->input('kid_friendly'),
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

    public function listing_status(Request $request){
        $validated = $request->validate([
            'listing_id' => 'required',
            'isActive' => 'required|boolean'
        ]);
        if($validated){
            Listing::where('listing_id', $request->input('listing_id'))->update([
                'isActive' => $request->input('isActive')
            ]);
            return response()->json([
                'status' => 200,
                'messege' => 'Listing Status Changed'
            ]);
        }else{
           $validated->errors();
        }
       
    }


    public function add_fav(Request $request){
        $validated = $request->validate([
            'user_id' => 'required',
            'listing_id' => 'required'
        ]);
        $check = FavListing::where('listing_id', $request->input('listing_id'))->where('user_id', $request->input('user_id'))->get();

        if(count($check)>0){
            return response()->json([
                'status' => 200,
                'messege' => 'Listing already exists'
            ]);
        }else{
            FavListing::create([
                'user_id' => $request->input('user_id'),
                'listing_id' => $request->input('listing_id'),
                'fav_type' => $request->input('fav_type')
            ]);
            return response()->json([
                'status' => 200,
                'messege' => 'Listing added to favourite'
            ]);
        }
      
    }

    public function get_fav(Request $request, $id){
        $favs = FavListing::where('user_id', $id)->with('listing.images')->with('listing.amenities')->with('listing.restrictions')->get();
        return response()->json([
            'status' => 200,
            'Favourites' => $favs
        ]);
    }

    public function del_fav(Request $request, $id){
        $listing = FavListing::where('id', $id)->get();
        if(count($listing)>0){
            FavListing::where('id', $id)->delete();
         return response()->json([
            'status' => 200,
            'messege' => 'Favourite listing removed'
         ]);
        }else{
            return response()->json([
                'status' =>200,
                'messege' => 'Listing not found'
            ]);
        }
        
    }
}
