<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;

    protected $fillable = [
            'guest_number',
            'bed_number' ,
            'bathroom_number',
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
}
