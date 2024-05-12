<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @method static orderBy(mixed $orderByName, mixed $orderBy)
 * @method static findOrFail($id)
 * @method static create(array $all)
 * @method static whereIn(string $string, mixed $ids)
 */
class Transportation extends Model
{
    use HasFactory;

    protected  $table = 'transportations';
    protected $fillable = [
        'name',
        'status'
    ];

    public function tours(): BelongsToMany {
        return $this->belongsToMany(Tour::class, 'tour_transportation');
    }
}
