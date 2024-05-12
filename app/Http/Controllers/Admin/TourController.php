<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateTourRequest;
use App\Http\Requests\UpdateTourRequest;
use App\Http\Resources\Admin\TourResource;
use App\Models\Tour;
use App\Models\TourHighlight;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
class TourController extends Controller
{
    public function find($id): TourResource {
        return new TourResource(Tour::findOrFail($id));
    }

    public function create(CreateTourRequest $request): JsonResponse {
        $tour = Tour::create($request->all());

        if($request->hasFile('images')) {
            $tour->addMultipleMediaFromRequest(['images'])
                ->each(function ($image) {
                    $image->toMediaCollection('featureImage');
                });
        }

        $tourHighlights = $request['tourHighlights'];

        if(!empty($tourHighlights)) {
            $tour->tourHighlights()->createMany($tourHighlights);
        }

        $tourItineraries = $request['tourItineraries'];

        if(!empty($tourItineraries)) {
            $tour->tourItineraries()->createMany($tourItineraries);
        }

        $tourCosts = $request['tourCosts'];

        if(!empty($tourCosts)) {
            $tour->tourCosts()->createMany($tourCosts);
        }

        $tourPrices = $request['tourPrices'];

        if(!empty($tourPrices)) {
            $tour->tourPrices()->createMany($tourPrices);
        }

        $transportationIds = collect($request['transportations'])->pluck('id')->all();

        if(!empty($transportationIds)) {
            $tour->transportations()->sync($transportationIds);
        }

        $languageIds = collect($request['languages'])->pluck('id')->all();

        if(!empty($languageIds)) {
            $tour->languages()->sync($languageIds);
        }

        $destinationIds = collect($request['destinations'])->pluck('id')->all();

        if(!empty($destinationIds)) {
            $tour->destinations()->sync($destinationIds);
        }

        $activityIds = collect($request['activities'])->pluck('id')->all();

        if(!empty($activityIds)) {
            $tour->activities()->sync($activityIds);
        }

        $typeIds = collect($request['types'])->pluck('id')->all();

        if(!empty($typeIds)) {
            $tour->types()->sync($typeIds);
        }

        $mealIds = collect($request['meals'])->pluck('id')->all();

        if(!empty($mealIds)) {
            $tour->meals()->sync($mealIds);
        }

        return $this->sendResponse(true);
    }

    public function update(UpdateTourRequest $request, $id): JsonResponse {

        $tour = Tour::findOrFail($id);
        $tour->update($request->all());

        if($request->hasFile('images')) {
            $tour->clearMediaCollection('featureImage');
            $tour->addMultipleMediaFromRequest(['images'])
                ->each(function ($image) {
                    $image->toMediaCollection('featureImage');
                });
        }

        $tourHighlights = $request['tourHighlights'];

        if(!empty($tourHighlights)) {
            foreach ($tourHighlights as $tourHighlight) {
                $tourHighlightId = $tourHighlight['id'] ?? null;
                if($tourHighlightId) {
                    $tourHighlight = $tour->tourHighlights()->findOrFaill($tourHighlightId);
                    $tourHighlight->update($tourHighlight);
                } else {
                    $tour->tourHighlights()->create($tourHighlight);
                }
            }
        }

        $tourItineraries = $request['tourItineraries'];

        if(!empty($tourItineraries)) {
            foreach ($tourItineraries as $tourItinerary) {
                $tourItineraryId = $tourItinerary['id'] ?? null;
                if($tourItineraryId) {
                    $tourItinerary = $tour->tourItineraries()->findOrFaill($tourItineraryId);
                    $tourItinerary->update($tourItinerary);
                } else {
                    $tour->tourItineraries()->create($tourItinerary);
                }
            }
        }

        $tourCosts = $request['tourCosts'];

        if(!empty($tourCosts)) {
            foreach ($tourCosts as $tourCost) {
                $tourCostId = $tourCost['id'] ?? null;
                if($tourCostId) {
                    $tourCost = $tour->tourCosts()->findOrFaill($tourCostId);
                    $tourCost->update($tourCost);
                } else {
                    $tour->tourCosts()->create($tourCost);
                }
            }
        }

        $tourPrices = $request['tourPrices'];

        if(!empty($tourPrices)) {
            foreach ($tourPrices as $tourPrice) {
                $tourPriceId = $tourPrice['id'] ?? null;
                if($tourPriceId) {
                    $tourPrice = $tour->tourPrices()->findOrFaill($tourPriceId);
                    $tourPrice->update($tourPrice);
                } else {
                    $tour->tourPrices()->create($tourPrice);
                }
            }
        }

        $transportationIds = collect($request['transportations'])->pluck('id')->all();

        if(!empty($transportationIds)) {
            $tour->transportations()->sync($transportationIds);
        }

        $languageIds = collect($request['languages'])->pluck('id')->all();

        if(!empty($languageIds)) {
            $tour->languages()->sync($languageIds);
        }

        $destinationIds = collect($request['destinations'])->pluck('id')->all();

        if(!empty($destinationIds)) {
            $tour->destinations()->sync($destinationIds);
        }

        $activityIds = collect($request['activities'])->pluck('id')->all();

        if(!empty($activityIds)) {
            $tour->activities()->sync($activityIds);
        }

        $typeIds = collect($request['types'])->pluck('id')->all();

        if(!empty($typeIds)) {
            $tour->types()->sync($typeIds);
        }

        $mealIds = collect($request['meals'])->pluck('id')->all();

        if(!empty($mealIds)) {
            $tour->meals()->sync($mealIds);
        }

        return $this->sendResponse(true);
    }

    public function delete($id): JsonResponse {
        $tour = Tour::findOrFail($id);
        $tour->clearMediaCollection('featureImage')->delete();
        return $this->sendResponse(true);
    }

    public function search(Request $request): AnonymousResourceCollection {
        $search = $request['search'];
        $orderByName = $request['orderByName'];
        $orderBy = $request['orderBy'];
        $perPage = $request['perPage'];
        $pageNumber = $request['pageNumber'];

        $tours = Tour::query();

        if(!empty($search)) {
            $tours = $tours->where('title', 'like', `%{$search}%`);
        }
        $tours = $tours->orderBy($orderByName, $orderBy)->paginate($perPage, ['*'], 'page', $pageNumber);
        return TourResource::collection($tours);
    }

    public function changeStatus(Request $request): JsonResponse {
        $ids = $request['ids'];
        $status = $request['status'];
        if(!empty($ids)) {
            $tours = Tour::whereIn('id', $ids)->get();

            foreach ($tours as $tour) {
                $tour->update([
                    'status' => $status
                ]);
            }
            return $this->sendResponse(true);
        }
        return $this->sendResponse(false);
    }

    public function multipleDelete(Request $request): JsonResponse {
        $ids = $request['ids'];
        if(!empty($ids)) {
            $tours = Tour::whereIn('id', $ids)->get();

            foreach ($tours as $tour) {
                $tour->clearMediaCollection('featureImage');
                $tour->delete();
            }
            return $this->sendResponse(true);
        }
        return $this->sendResponse(false);

    }
}
