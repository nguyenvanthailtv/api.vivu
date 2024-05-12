<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static create(array $all)
 * @method static findOrFail($id)
 * @method static whereIn(string $string, mixed $ids)
 */
class PostCategory extends Model
{
    use HasFactory;

    protected $table = 'post_categories';

    protected $fillable = [
        'name',
        'slug',
        'status',
    ];

    public function posts(): HasMany {
        return $this->hasMany(Post::class, 'post_category_id');
    }

}
