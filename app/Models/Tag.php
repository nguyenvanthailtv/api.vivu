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
class Tag extends Model
{
    use HasFactory;

    protected $table = 'tags';

    protected $fillable = [
        'name',
        'slug',
        'status',
    ];

    public function posts(): BelongsToMany {
        return $this->belongsToMany(Post::class, 'post_tag');
    }
}
