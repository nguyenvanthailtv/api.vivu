<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TourResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'title' => $this->title,
            'slug' => $this->slug,
            'intro' => $this->intro,
            'overview' => $this->overview,
            'featureImage' => $this->featureImage,
            'max_altitude' => $this->max_altitude,
            'departure_city' => $this->departure_city,
            'best_season' => $this->best_season,
            'walking_hour' => $this->walking_hour,
            'wifi' => $this->wifi,
            'min_age' => $this->min_age,
            'max_age' => $this->max_age,
            'quantity' => $this->quantity,
            'duration' => $this->duration,
            'status' => $this->status,
            'accommodation' => $this->accommodation,
            'transportations' => $this->transportations,
            'tourHighlights' => $this->tourHighlights,
            'tourItineraries' => $this->tourItineraries,
            'tourCosts' => $this->tourCosts,
            'tourPrices' => $this->tourPrices,
            'languages' => $this->languages,
            'destinations' => $this->destinations,
            'activities' => $this->activities,
            'types' => $this->types,
            'meals' => $this->meals,
        ];
    }
}
