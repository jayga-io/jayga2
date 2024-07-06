<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ListingReportCategories;
use App\Models\User;
use App\Models\Listing;

class Reports extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function report_category(){
        return $this->hasOne(ListingReportCategories::class, 'report_category_id', 'id');
    }

    public function user(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function lister(){
        return $this->hasOne(User::class, 'id', 'lister_id');
    }

    public function listing(){
        return $this->hasOne(Listing::class, 'listing_id', 'listing_id');
    }
}
