<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Listing;
use App\Models\Booking;

class Notification extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function listings(){
        return $this->hasOne(Listing::class, 'listing_id', 'listing_id');
    }

    public function bookings(){
        return $this->hasOne(Booking::class, 'booking_id', 'booking_id');
    }
}
