<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ListingImages;

class Listing extends Model
{
    use HasFactory;

    protected $fillable = [
            'lister_id',
            'lister_name',
            'guest_num',
            'bed_num' ,
            'bathroom_num',
            'listing_title' ,
            'listing_description' ,
            'full_day_price_set_by_user', 
            'listing_address' ,
            'zip_code' ,
            'district' ,
            'town' ,
            'allow_short_stay', 
            'describe_peaceful' ,
            'describe_unique', 
            'describe_familyfriendly', 
            'describe_stylish' ,
            'describe_central' ,
            'describe_spacious' ,
            'private_bathroom' ,
            'breakfast_included' ,
            'door_lock' ,
            'unknown_guest_entry' ,
            'listing_type',
    ];

    public function images(){
        return $this->hasMany(ListingImages::class, 'listing_id', 'listing_id');
    }
}
