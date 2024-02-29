<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Listing;
use App\Models\ListingImages;

class FavListing extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function listing(){
        return $this->hasOne(Listing::class, 'listing_id', 'listing_id');
    }

    public function listing_image(){
        return $this->hasMany(ListingImages::class, 'listing_id', 'listing_id');
    }
}
