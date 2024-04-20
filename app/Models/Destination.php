<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Destination extends Model
{
    use HasFactory;

    protected $table = 'destinations';
    protected $fillable = [
        'name',
        'image'
    ];

    public function tourDestination():HasMany {
        return $this->hasMany(TourDestination::class, 'destination_id');
    }
}
