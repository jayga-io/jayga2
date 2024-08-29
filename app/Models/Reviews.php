<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\UserPictures;
use App\Models\Listing;

class Reviews extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function user(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function user_avatar(){
        return $this->hasOne(UserPictures::class, 'user_id', 'user_id');
    }

    public function listing(){
        return $this->hasOne(Listing::class, 'listing_id', 'listing_id');
    }

    
}
