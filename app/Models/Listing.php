<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ListingImages;
use App\Models\ListingDescribe;
use App\Models\ListingAvailable;
use App\Models\ListingGuestAmenities;
use App\Models\ListingRestrictions;
use App\Models\Booking;
use App\Models\Reviews;
use App\Models\ListingAmenities;
use App\Models\ListingRestricts;

class Listing extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function images(){
        return $this->hasMany(ListingImages::class, 'listing_id', 'listing_id');
    }

    public function newAmenities(){
        return $this->hasMany(ListingAmenities::class, 'listing_id', 'listing_id');
    }

    public function newRestrictions(){
        return $this->hasMany(ListingRestricts::class, 'listing_id', 'listing_id');
    }

    public function booking(){
        return $this->hasMany(Booking::class, 'listing_id', 'listing_id');
    }

    public function amenities(){
        return $this->hasOne(ListingGuestAmenities::class, 'listing_id', 'listing_id');
    }

    public function restrictions(){
        return $this->hasOne(ListingRestrictions::class, 'listing_id', 'listing_id');
    }

    public function reviews(){
        return $this->hasMany(Reviews::class, 'listing_id', 'listing_id');
    }

    public function host(){
        return $this->hasOne(User::class, 'id', 'lister_id');
    }

    public function disable_dates(){
        return $this->hasMany(ListingAvailable::class, 'listing_id', 'listing_id');
    }

    
  
}
