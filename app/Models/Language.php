<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Language extends Model
{
    use HasFactory;

    protected $table = 'languages';
    protected $fillable = [
        'name',
        'flag',
        'status'
    ];

    public function tourLanguage(): HasMany {
        return $this->hasMany(TourLanguage::class , 'language_id');
    }
}
