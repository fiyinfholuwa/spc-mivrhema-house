<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConferenceFeedback extends Model
{
    protected $fillable = [
        'full_name',
        'email',
        'rating_overall',
        'spiritual_impact',
        'highlight_sessions',
        'content_quality',
        'speaker_rating',
        'logistics',
        'venue_rating',
        'attend_again',
        'improvements',
        'testimonies',
    ];

}
