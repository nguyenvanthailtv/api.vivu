<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Casts\Attribute;

/**
 * @method static orderBy(mixed $orderByName, mixed $orderBy)
 * @method static findOrFail($id)
 * @method static create(array $all)
 * @method static whereIn(string $string, mixed $ids)
 */
class Type extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $table = 'types';
    protected $fillable = [
        'name',
        'slug',
        'status'
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

    public function tours(): BelongsToMany {
        return $this->belongsToMany(Tour::class, 'tour_type');
    }
}
