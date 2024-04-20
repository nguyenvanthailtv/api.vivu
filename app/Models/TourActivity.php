<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TourActivity extends Model
{
    use HasFactory;

    protected $table = 'tour_activities';

    protected $fillable = [
        'tour_id',
        'activity_id'
    ];

    public function tour(): BelongsTo {
        return $this->belongsTo(Tour::class, 'tour_id');
    }

    public function activity(): BelongsTo {
        return $this->belongsTo(Activity::class, 'activity_id');
    }
}
