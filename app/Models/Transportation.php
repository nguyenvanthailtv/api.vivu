<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transportation extends Model
{
    use HasFactory;

    protected  $table = 'transportations';
    protected $fillable = [
        'title',
        'status'
    ];

    public  function  tourTransportations(): BelongsTo {
        return $this->belongsTo(TourTransportation::class, 'transportation_id');
    }
}
