<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Vouchar;

class UserVouchar extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function users(){
        return $this->hasMany(User::class, 'id', 'user_id');
    }

    public function vouchars(){
        return $this->hasMany(Vouchar::class, 'id', 'vouchar_id');
    }
}
