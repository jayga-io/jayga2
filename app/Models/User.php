<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\UserPictures;
use App\Models\UserNid;
use App\Models\Inventory;
use App\Models\BusinessLocation;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function avatars(){
        return $this->hasOne(UserPictures::class, 'user_id', 'id');
    }

    public function bookings(){
        return $this->hasMany(Booking::class, 'user_id', 'id');
    }

    public function nids(){
        return $this->hasMany(UserNid::class, 'user_id', 'id');
    }

    public function listings(){
        return $this->hasMany(Listing::class, 'lister_id', 'id');
    }

    public function inventories(){
        return $this->hasMany(Inventory::class, 'user_id', 'id');
    }

    public function business_locations(){
        return $this->hasMany(BusinessLocation::class, 'user_id', 'id');
    }
}
