<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TourLanguage extends Model
{
    use HasFactory;

    protected $table = 'tour_languages';

    protected $fillable = [
        'tour_id',
        'language_id'
    ];

    public function tour():BelongsTo {
        return $this->belongsTo(Tour::class, 'tour_id');
    }

    public function language():BelongsTo {
        return $this->belongsTo(Language::class, 'language_id');
    }
}
