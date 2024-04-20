<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Feedback extends Model
{
    use HasFactory;

    protected $table = 'feedbacks';

    protected $fillable = [
        'tour_id',
        'name',
        'email',
        'country_id',
        'phone_number',
        'adult',
        'child',
        'title',
        'description',
        'status'
    ];

    public function tour(): BelongsTo {
        return  $this->belongsTo(Tour::class, 'tour_id');
    }

    public function country(): BelongsTo {
        return  $this->belongsTo(Country::class, 'country_id');
    }
}
