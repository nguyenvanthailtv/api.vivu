<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateDestinationRequest;
use App\Http\Requests\UpdateDestinationRequest;
use App\Http\Resources\Admin\DestinationResource;
use App\Models\Destination;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class DestinationController extends Controller
{
    public function all(Request $request): AnonymousResourceCollection
    {
        $orderByName = $request['orderByName'];
        $orderBy = $request['orderBy'];
        $perPage = $request['perPage'];
        $pageNumber = $request['pageNumber'];
        $destinations = Destination::orderBy($orderByName, $orderBy)->paginate($perPage, ['*'], 'page', $pageNumber);

        return DestinationResource::collection($destinations);
    }

    public function find($id): DestinationResource
    {
        $destination = Destination::findOrFail($id);

        return new DestinationResource($destination);
    }

    public function create(CreateDestinationRequest $request): JsonResponse
    {
        $destination = Destination::create($request->all());
        if($request->hasFile('image')) {
            $destination->addMedia($request->file('image'))
                ->toMediaCollection('featureImage');
        }

        return $this->sendResponse(true);
    }

    public function update(UpdateDestinationRequest $request, $id): JsonResponse
    {
        $destination = Destination::findOrFail($id);
        $destination->update($request->all());
        if($request->hasFile('image')) {
            $destination->addMedia($request->file('image'))
                ->toMediaCollection('featureImage');
        }

        return $this->sendResponse(true);
    }

    public function delete($id): JsonResponse
    {
        $destination = Destination::findOrFail($id);

        $destination->clearMediaCollection('featureImage')->delete();

        return $this->sendResponse(true);
    }

    public function search(Request $request): AnonymousResourceCollection
    {
        $search = $request['search'];
        $orderByName = $request['orderByName'];
        $orderBy = $request['orderBy'];
        $perPage = $request['perPage'];
        $pageNumber = $request['pageNumber'];
        $destinations = Destination::query();

        if(!empty($search)) {
            $destinations = $destinations->where('name', 'like', `%{$search}%`);
        }

        $destinations = $destinations->orderBy($orderByName, $orderBy)->paginate($perPage, ['*'], 'page', $pageNumber);
        return DestinationResource::collection($destinations);
    }

    public function changeStatus(Request $request): JsonResponse
    {
        $ids = $request['ids'];
        $status = $request['status'];

        if(!empty($ids)) {
            $destinations = Destination::whereIn('id', $ids)->get();

            foreach ($destinations as $destination) {
                $destination->update([
                    'status' => $status
                ]);
            }

            return $this->sendResponse(true);
        }

        return $this->sendResponse(false);

    }

    public function multipleDelete(Request $request): JsonResponse
    {
        $ids = $request['ids'];
        if(!empty($ids)) {
            $destinations = Destination::whereIn('id', $ids)->get();

            foreach ($destinations as $destination) {

                $destination->clearMediaCollection('featureImage')->delete();
            }

            return $this->sendResponse(true);
        }
        return $this->sendResponse(false);

    }

}
