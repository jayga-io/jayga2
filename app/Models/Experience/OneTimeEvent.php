<?php

namespace App\Models\Experience;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OneTimeEvent extends Model
{
    use HasFactory;
    protected $fillable = [
        'host_id', 'event_name', 'location', 'date', 'start_time', 'duration',
        'ticket_categories'
    ];

    public function host()
    {
        return $this->belongsTo(User::class);
    }
}
