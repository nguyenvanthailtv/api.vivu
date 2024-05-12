<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @method static create(array $all)
 * @method static findOrFail($id)
 * @method static whereIn(string $string, mixed $ids)
 */
class Meal extends Model
{
    use HasFactory;

    protected $table = 'meals';

    protected $fillable = [
        'name',
        'status'
    ];

    public function tours(): BelongsToMany{
        return $this->belongsToMany(Tour::class, 'tour_meal');
    }
}
