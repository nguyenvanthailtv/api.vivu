<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TourPrice extends Model
{
    use HasFactory;

    protected $table = 'tour_prices';

    protected $fillable = [
        'tour_id',
        'start_date',
        'price',
        'status',
        'discount'
    ];

    public function tour(): BelongsTo {
        return $this->belongsTo(Tour::class, 'tour_id');
    }
}
