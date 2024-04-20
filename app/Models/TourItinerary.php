<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TourItinerary extends Model
{
    use HasFactory;

    protected $table = 'tour_itineraries';

    protected $fillable = [
        'title',
        'day',
        'description',
        'tour_id',
        'order',
        'status'
    ];

    public function tour(): BelongsTo {
        return $this->belongsTo(Tour::class, 'tour_id');
    }
}
