<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TourImage extends Model
{
    use HasFactory;

    protected $table = 'tour_images';
    protected $fillable = [
        'url',
        'tour_id',
        'status'
    ];

    public  function  tour(): BelongsTo
    {
        return  $this->belongsTo(Tour::class, 'tour_id');
    }
}
