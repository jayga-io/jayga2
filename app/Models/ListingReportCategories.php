<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Reports;

class ListingReportCategories extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function reports(){
       return $this->belongsTo(Reports::class, 'id', 'id');
    }
}
