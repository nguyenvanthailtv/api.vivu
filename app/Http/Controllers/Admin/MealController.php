<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateMealRequest;
use App\Http\Requests\UpdateMealRequest;
use App\Http\Resources\Admin\MealResource;
use App\Models\Meal;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class MealController extends Controller
{
    public function create(CreateMealRequest $request): JsonResponse
    {
        Meal::create($request->all());
        return $this->sendResponse(true);
    }

    public function update(UpdateMealRequest $request, $id): JsonResponse
    {
        $meal = Meal::findOrFail($id);
        $meal->update($request->all());

        return $this->sendResponse(true);
    }

    public function find($id): MealResource {
        return new MealResource(Meal::findOrFail($id));
    }

    public function search(Request $request): AnonymousResourceCollection
    {
        $search = $request['search'];
        $orderByName = $request['orderByName'];
        $orderBy = $request['orderBy'];
        $perPage = $request['perPage'];
        $pageNumber = $request['pageNumber'];
        $meals = Meal::query();

        if(!empty($search)) {
            $meal = $meals->where('name', 'like', `%{$search}%`);
        }

        $meals = $meals->orderBy($orderByName, $orderBy)->paginate($perPage, ['*'], 'page', $pageNumber);
        return MealResource::collection($meals);
    }

    public function changeStatus(Request $request): JsonResponse {
        $ids = $request['ids'];
        $status = $request['status'];

        if(!empty($ids)) {
            $meals = Meal::whereIn('id', $ids)->get();

            foreach ($meals as $meal) {
                $meal->update([
                    'status' => $status
                ]);
            }

            return $this->sendResponse(true);
        }
        return $this->sendResponse(false);
    }

    public function delete($id): JsonResponse {
        $meal = Meal::findOrFail($id);
        $meal->delete();
        return $this->sendResponse(true);
    }

    public function multipleDelete(Request $request): JsonResponse {
        $ids = $request['ids'];

        if(!empty($ids)) {
            $meals = Meal::whereIn('id', $ids)->get();

            foreach ($meals as $meal) {
                $meal->delete();
            }

            return $this->sendResponse(true);
        }
        return $this->sendResponse(false);
    }
}
