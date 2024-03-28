<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Listing;

class ListingRestricts extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function listing(){
        return $this->belongsTo(Listing::class, 'listing_id', 'listing_id');
    }
}
