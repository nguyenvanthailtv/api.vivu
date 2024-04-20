<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TourHighlight extends Model
{
    use HasFactory;

    protected $table = 'tour_highlights';

    protected $fillable = [
        'title',
        'tour_id',
        'order',
        'status'
    ];

    public  function  tour(): BelongsTo
    {
        return  $this->belongsTo(Tour::class, 'tour_id');
    }
}
