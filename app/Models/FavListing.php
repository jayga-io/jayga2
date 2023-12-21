<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FavListing extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function listing(){
        return $this->hasMany(Listing::class, 'listing_id', 'listing_id');
    }
}
