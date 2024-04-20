<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TourDestination extends Model
{
    use HasFactory;

    protected $table = 'tour_destinations';

    protected $fillable = [
        'tour_id',
        'destination_id'
    ];

    public function tour(): BelongsTo {
        return $this->belongsTo(Tour::class, 'tour_id');
    }

    public function destination(): BelongsTo {
        return  $this->belongsTo(Destination::class, 'destination_id');
    }
}
