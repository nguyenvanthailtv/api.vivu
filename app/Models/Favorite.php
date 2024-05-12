<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Favorite extends Model
{
    use HasFactory;

    protected $table = 'favorites';

    protected $fillable = [
        'favorite_table_type',
        'favorite_table_id',
        'user_id'
    ];

    public function favorite_table(): MorphTo
    {
        return $this->morphTo();
    }
}
