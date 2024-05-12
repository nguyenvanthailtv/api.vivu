<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Casts\Attribute;

/**
 * @method static orderBy(mixed $orderByName, mixed $orderBy)
 * @method static findOrFail($id)
 * @method static create(array $all)
 * @method static whereIn(string $string, mixed $ids)
 */
class Activity extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $table = 'activities';

    protected $fillable = [
        'name',
        'slug',
        'status',
    ];

    public function registerMediaCollections(): void {
        $this->addMediaCollection('featureImage')
            ->singleFile();
    }

//    public function registerMediaConversions(Media $media = null): void {
//        $this
//            ->addMediaConversion('thumb')
//            ->performOnCollections('featureImage')
//            ->quality(100)
//            ->width(500)
//            ->nonQueued();

//        $this
//            ->addMediaConversion('cover')
//            ->performOnCollections('featureImage')
//            ->quality(100)
//            ->withResponsiveImages()
//            ->nonQueued();
//    }


//    public function coverImage(): Attribute
//    {
//        return Attribute::make(
//            get: fn () => $this->getFirstMedia('featureImage') ? $this->getFirstMedia('featureImage')->getSrcset('cover') : ''
//        );
//    }
//
//    public function thumbImage(): Attribute
//    {
//        return Attribute::make(
//            get: fn () => $this->getFirstMedia('featureImage') ? $this->getFirstMedia('featureImage')->getUrl('thumb') : ''
//        );
//    }

    public function featureImage(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->getFirstMedia('featureImage') ? $this->getFirstMedia('featureImage')->getUrl() : ''
        );
    }

    public function tours(): BelongsToMany {
        return $this->belongsToMany(Tour::class, 'tour_activity');
    }
}
