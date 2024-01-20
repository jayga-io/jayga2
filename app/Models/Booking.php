<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Listing;
use App\Models\TimeSlotShortstays;

class Booking extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function listings(){
        return $this->belongsTo(Listing::class, 'listing_id', 'listing_id');
    }

    public function short_stays(){
        return $this->hasMany(TimeSlotShortstays::class, 'time_id', 'tier');
    }


}
