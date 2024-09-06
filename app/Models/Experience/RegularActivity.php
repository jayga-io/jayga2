<?php

namespace App\Models\Experience;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegularActivity extends Model
{
    use HasFactory;
    protected $fillable = [
        'host_id', 'activity_name', 'location', 'duration', 'start_time',
        'available_weekdays', 'ticket_price', 'ticket_categories'
    ];

    public function host()
    {
        return $this->belongsTo(User::class);
    }
}
