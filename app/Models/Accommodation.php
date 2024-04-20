<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Accommodation extends Model
{
    use HasFactory;

    protected $table = 'accommodations';
    protected $fillable = [
        'title',
        'status'
    ];

    public function tours(): HasMany {
        return $this->hasMany(Tour::class, 'accommodation_id');
    }
}
