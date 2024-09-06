<?php

namespace App\Models\Experience;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackageTour extends Model
{
    use HasFactory;
    protected $fillable = [
        'host_id', 'location', 'attractions', 'days', 'ticket_categories'
    ];

    public function host()
    {
        return $this->belongsTo(User::class);
    }

    public function guests()
    {
        return $this->belongsToMany(User::class, 'package_tour_guest');
    }
}
