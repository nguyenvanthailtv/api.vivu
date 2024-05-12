<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Casts\Attribute;

/**
 * @method static findOrFail($id)
 * @method static create(array $all)
 * @method static whereIn(string $string, mixed $ids)
 */
class Tour extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $table = 'tours';
    protected $fillable = [
        'title',
        'slug',
        'intro',
        'overview',
        'max_altitude',
        'departure_city',
        'best_season',
        'walking_hour',
        'wifi',
        'min_age',
        'max_age',
        'quantity',
        'duration',
        'status',
        'accommodation_id',
    ];

    public function registerMediaCollections(): void {
        $this->addMediaCollection('featureImage');
    }

    public function featureImage(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->getMediaCollection('featureImage') ? $this->getMediaCollection('featureImage') : ''
        );
    }

    public function accommodation(): BelongsTo {
        return $this->belongsTo(Accommodation::class, 'accommodation_id');
    }

    public function transportations(): BelongsToMany {
        return $this->belongsToMany(Transportation::class, 'tour_transportation');
    }

    public  function tourHighlights(): HasMany {
        return  $this->hasMany(TourHighlight::class, 'tour_id');
    }

    public  function  tourItineraries():HasMany {
        return $this->hasMany(TourItinerary::class, 'tour_id');
    }

    public function tourCosts(): HasMany {
        return  $this->hasMany(TourCost::class, 'tour_id');
    }

    public function feedbacks(): HasMany {
        return $this->hasMany(Feedback::class, 'tour_id');
    }

    public function tourPrices(): HasMany {
        return $this->hasMany(TourPrice::class, 'tour_id');
    }

    public function languages(): BelongsToMany {
        return $this->belongsToMany(Language::class, 'tour_language');
    }

    public function destinations(): BelongsToMany {
        return $this->belongsToMany(Destination::class, 'tour_destination');
    }
    public function activities(): BelongsToMany {
        return $this->belongsToMany(Activity::class, 'tour_activity');
    }

    public function types(): BelongsToMany {
        return $this->belongsToMany(Type::class, 'tour_type');
    }

    public function favorites(): MorphMany {
        return $this->morphMany(Favorite::class, 'favorite_table');
    }

    public function meals(): BelongsToMany {
        return $this->belongsToMany(Meal::class, 'tour_meal');
    }
}
