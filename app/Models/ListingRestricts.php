<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Listing;
use App\Models\RestrictionList;

class ListingRestricts extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function listing(){
        return $this->belongsTo(Listing::class, 'listing_id', 'listing_id');
    }

    public function restrictions(){
        return $this->hasOne(RestrictionList::class, 'id', 'restriction_id');
    }
}
