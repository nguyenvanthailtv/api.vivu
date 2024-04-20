<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TourTransportation extends Model
{
    use HasFactory;

    protected $table = 'tour_transportations';

    protected $fillable = [
        'tour_id',
        'transportation_id',
        'status'
    ];
    public function tour(): BelongsTo {
        return $this->belongsTo(Tour::class, 'tour_id');
    }

    public  function transportation(): BelongsTo {
        return $this->belongsTo(Transportation::class, 'transportation_id');
    }
}
