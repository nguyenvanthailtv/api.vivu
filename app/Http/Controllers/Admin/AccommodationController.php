<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateAccommodationRequest;
use App\Http\Requests\UpdateAccommodationRequest;
use App\Http\Resources\Admin\AccommodationResource;
use App\Models\Accommodation;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
class AccommodationController extends Controller
{
    public function create(CreateAccommodationRequest $request): JsonResponse
    {
        Accommodation::create($request->all());
        return $this->sendResponse(true);
    }

    public function update(UpdateAccommodationRequest $request, $id): JsonResponse
    {
        $accommodation = Accommodation::findOrFail($id);
        $accommodation->update($request->all());

        return $this->sendResponse(true);
    }

    public function find($id): AccommodationResource
    {
        return new AccommodationResource(Accommodation::findOrFail($id));
    }

    public function search(Request $request): AnonymousResourceCollection
    {
        $search = $request['search'];
        $orderByName = $request['orderByName'];
        $orderBy = $request['orderBy'];
        $perPage = $request['perPage'];
        $pageNumber = $request['pageNumber'];
        $accommodations = Accommodation::query();
        if(!empty($search)) {
            $accommodations = $accommodations->where('name' , 'Like', `%{$search}%`);
        }
        $accommodations = $accommodations->orderBy($orderByName, $orderBy)->paginate($perPage, ['*'], 'page', $pageNumber);

        return AccommodationResource::collection($accommodations);
    }

    public function all(Request $request): AnonymousResourceCollection
    {
        $orderByName = $request['orderByName'];
        $orderBy = $request['orderBy'];
        $perPage = $request['perPage'];
        $pageNumber = $request['pageNumber'];
        $accommodations = Accommodation::orderBy($orderByName, $orderBy)->paginate($perPage, ['*'], 'page', $pageNumber);
        return AccommodationResource::collection($accommodations);
    }

    public function changeStatus(Request $request): JsonResponse
    {
        $ids = $request['ids'];
        $status = $request['status'];

        if(!empty($ids)) {
            $accommodations = Accommodation::whereIn('id', $ids)->get();

            foreach ($accommodations as $accommodation) {
                $accommodation->update([
                    'status' => $status
                ]);
            }
            return  $this->sendResponse(true);
        }

        return  $this->sendResponse(false);

    }

    public function delete($id): JsonResponse
    {
        $accommodation = Accommodation::findOrFail($id);

        $accommodation->delete();

        return $this->sendResponse(true);
    }

    public function multipleDelete(Request $request): JsonResponse
    {
        $ids = $request['ids'];

        if(!empty($ids)) {
            $accommodations = Accommodation::whereIn('id', $ids)->get();

            foreach ($accommodations as $accommodation) {
                $accommodation->delete();
            }

            return $this->sendResponse(true);
        }
        return $this->sendResponse(false);
    }

}
