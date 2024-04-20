<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Tour extends Model
{
    use HasFactory;

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

    public function accommodation(): BelongsTo {
        return $this->belongsTo(Accommodatio::class, 'accommodation_id');
    }

    public function tourTransportations(): HasMany {
        return $this->hasMany(TourTransportation::class, 'tour_id');
    }

    public  function  tourImages(): HasMany {
        return  $this->hasMany(TourImage::class, 'tour_id');
    }

    public  function  tourHighlights(): HasMany {
        return  $this->hasMany(TourHighlight::class, 'tour_id');
    }

    public  function  tourItineraries():HasMany {
        return $this->hasMany(TourItinerary::class, 'tour_id');
    }

    public function  tourCosts(): HasMany {
        return  $this->hasMany(TourCost::class, 'tour_id');
    }

    public function feedbacks(): HasMany {
        return $this->hasMany(Feedback::class, 'tour_id');
    }

    public function tourPrices(): HasMany {
        return $this->hasMany(TourPrice::class, 'tour_id');
    }

    public function tourLanguage(): HasMany {
        return $this->hasMany(TourLanguage::class , 'tour_id');
    }

    public function tourDestinations(): HasMany {
        return $this->hasMany(TourDestination::class, 'tour_id');
    }

    public function tourActivities():HasMany {
        return $this->hasMany(TourActivity::class, 'tour_id');
    }

    public function tourTypes():HasMany {
        return $this->hasMany(TourType::class, 'tour_id');
    }

    public function favorites(): MorphMany {
        return $this->morphMany(Favorite::class, 'favoriteable');
    }
}
