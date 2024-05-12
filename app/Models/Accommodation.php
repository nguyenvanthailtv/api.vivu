<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static findOrFail($id)
 * @method static create(array $all)
 * @method static orderBy(mixed $orderByName, mixed $orderBy)
 * @method static whereIn(string $string, mixed $ids)
 */
class Accommodation extends Model
{
    use HasFactory;

    protected $table = 'accommodations';
    protected $fillable = [
        'name',
        'status'
    ];

    public function tours(): HasMany {
        return $this->hasMany(Tour::class, 'accommodation_id');
    }
}
