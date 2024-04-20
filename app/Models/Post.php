<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use PhpParser\Comment;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';

    protected $fillable = [
        'post_category_id',
        'author_id'
    ];

    public function postCategory(): BelongsTo {
        return $this->belongsTo(PostCategory::class, 'post_category_id');
    }

    public function author(): BelongsTo {
        return $this->belongsTo(Author::class, 'author_id');
    }

    public function postTags(): HasMany {
        return $this->hasMany(PostTag::class, 'post_id');
    }

    public function postViews(): HasMany {
        return $this->hasMany(PostView::class, 'post_id');
    }

    public function favorites(): MorphMany {
        return $this->morphMany(Favorite::class, 'favoriteable');
    }


    public function comments(): HasMany {
        return $this->hasMany(Comment::class, 'post_id');
    }
}
