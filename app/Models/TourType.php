<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TourType extends Model
{
    use HasFactory;
    protected $table = 'tour_types';

    protected $fillable = [
        'tour_id',
        'type_id'
    ];

    public function tour(): BelongsTo {
        return $this->belongsTo(Tour::class, 'tour_id');
    }

    public function type(): BelongsTo {
        return $this->belongsTo(Type::class, 'type_id');
    }
}
