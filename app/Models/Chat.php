<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Listing;
use App\Models\Booking;

class Chat extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function user(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function lister(){
        return $this->hasOne(User::class, 'id', 'lister_id');
    }

    public function listing(){
        return $this->hasOne(Listing::class, 'listing_id', 'listing_id');
    }

    public function booking(){
        return $this->hasOne(Booking::class, 'booking_id', 'booking_id');
    }
}
