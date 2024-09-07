<?php

namespace App\Models\Experience;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegularTour extends Model
{
    use HasFactory;
    protected $fillable = [
        'host_id', 'location', 'number_of_days', 'number_of_nights', 'itinerary',
        'adult_ticket_price', 'child_ticket_price', 'meeting_point', 'drop_off_point'
    ];

    public function host()
    {
        return $this->belongsTo(User::class);
    }

    public function guests()
    {
        return $this->belongsToMany(User::class, 'regular_tour_guest');
    }
}
