<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Listing;

class Refunds extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function user(){
        return $this->hasOne(User::class, 'user_id', 'id');
    }

    public function listing(){
        return $this->hasOne(Listing::class, 'listing_id', 'listing_id');
    }
}
