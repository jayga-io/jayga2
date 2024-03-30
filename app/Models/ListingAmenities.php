<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Listing;
use App\Models\AmenitiesList;

class ListingAmenities extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function listing(){
        return $this->belongsTo(Listing::class, 'listing_id', 'listing_id');
    }

    public function amenity(){
        return $this->hasOne(AmenitiesList::class, 'id', 'amenities_id');
    }
}
