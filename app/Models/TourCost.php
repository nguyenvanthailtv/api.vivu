<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TourCost extends Model
{
    use HasFactory;

    protected $table = 'tour_costs';
    protected $fillable = [
        'tour_id',
        'title',
        'order',
        'status',
        'include'
    ];

    public function tour(): BelongsTo {
        return $this->belongsTo(Tour::class, 'tour_id');
    }
}
