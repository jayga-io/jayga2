<?php

namespace App\Models\Experience;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DayTour extends Model
{
    use HasFactory;
    protected $fillable = [
        'host_id', 'location', 'travel_plan', 'perks', 'restrictions', 'start_time', 
        'duration', 'days_available', 'adult_ticket_price', 'child_ticket_price',
        'meeting_point', 'drop_off_point', 'primary_address', 'district'
    ];

    public function host()
    {
        return $this->belongsTo(User::class);
    }

    public function guests()
    {
        return $this->belongsToMany(User::class, 'day_tour_guest');
    }
}
