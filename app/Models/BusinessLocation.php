<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Inventory;
use App\Models\User;

class BusinessLocation extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function inventories(){
        return $this->hasOne(Inventory::class, 'business_location_id', 'business_id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'id', 'user_id');
    }
}
