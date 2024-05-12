<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use PhpParser\Comment;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Casts\Attribute;

/**
 * @method static findOrFail($id)
 * @method static create(array $all)
 * @method static whereIn(string $string, mixed $ids)
 */
class Post extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $table = 'posts';

    protected $fillable = [
        'post_category_id',
        'author_id',
        'title',
        'slug',
        'description',
        'intro',
        'overview',
        'status',
    ];

    public function registerMediaCollections(): void {
        $this->addMediaCollection('featureImage')
            ->singleFile();
    }

    public function featureImage(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->getFirstMedia('featureImage') ? $this->getFirstMedia('featureImage')->getUrl() : ''
        );
    }

    public function postCategory(): BelongsTo {
        return $this->belongsTo(PostCategory::class, 'post_category_id');
    }

    public function author(): BelongsTo {
        return $this->belongsTo(Author::class, 'author_id');
    }

    public function tags(): BelongsToMany {
        return $this->belongsToMany(Tag::class, 'post_tag');
    }

    public function users(): BelongsToMany {
        return $this->belongsToMany(User::class, 'post_view');
    }

    public function favorites(): MorphMany {
        return $this->morphMany(Favorite::class, 'favorite_table');
    }


    public function comments(): HasMany {
        return $this->hasMany(Comment::class, 'post_id');
    }
}
