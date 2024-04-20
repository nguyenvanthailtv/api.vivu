<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;

    protected $table = 'favorites';

    protected $fillable = [
        'favoriteable_type',
        'favoriteable_id',
        'user_id'
    ];

    public function favoriteable()
    {
        return $this->morphTo();
    }
}
