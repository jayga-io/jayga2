<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListingImages extends Model
{
    use HasFactory;

    protected $fillable = [
        'listing_id',
        'lister_id',
        'listing_file_name',
        'listing_targetlocation',
    ];

    public function listings(){
        return $this->belongsTo(Listing::class, 'listing_id');
    }
}
