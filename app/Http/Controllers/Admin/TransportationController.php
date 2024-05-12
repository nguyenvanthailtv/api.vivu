<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateTransportationRequest;
use App\Http\Requests\UpdateTransportationRequest;
use App\Http\Resources\Admin\TransportationResource;
use App\Models\Transportation;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\JsonResponse;
class TransportationController extends Controller
{
    public function all(Request $request): AnonymousResourceCollection
    {
        $orderByName = $request['orderByName'];
        $orderBy = $request['orderBy'];
        $perPage = $request['perPage'];
        $pageNumber = $request['pageNumber'];
        $transportations = Transportation::orderBy($orderByName, $orderBy)->paginate($perPage, ['*'], 'page', $pageNumber);

        return TransportationResource::collection($transportations);
    }

    public function find($id): TransportationResource
    {
        return new TransportationResource(Transportation::findOrFail($id));
    }

    public function create(CreateTransportationRequest $request): JsonResponse
    {
        $transportation = Transportation::create($request->all());

        return $this->sendResponse(true);
    }

    public function update(UpdateTransportationRequest $request, $id): JsonResponse
    {
        $transportation = Transportation::findOrFail($id);

        $transportation->update($request->all());

        return $this->sendResponse(true);
    }

    public function delete($id): JsonResponse
    {
        $transportation = Transportation::findOrFail($id);

        $transportation->delete();

        return $this->sendResponse(true);
    }

    public function search(Request $request): AnonymousResourceCollection
    {
        $search = $request['search'];
        $orderByName = $request['orderByName'];
        $orderBy = $request['orderBy'];
        $perPage = $request['perPage'];
        $pageNumber = $request['pageNumber'];
        $transportations = Transportation::query();

        if(!empty($search)) {
            $transportations = $transportations->where('title', 'like', `%{$search}%`);
        }

        $transportations = $transportations->orderBy($orderByName, $orderBy)->paginate($perPage, ['*'], 'page', $pageNumber);
        return TransportationResource::collection($transportations);
    }

    public function changeStatus(Request $request) {
        $ids = $request['ids'];
        $status = $request['status'];

        if(!empty($ids)) {
            $transportations = Transportation::whereIn('id', $ids)->get();

            foreach ($transportations as $transportation) {
                $transportation->update([
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
            $transportations = Transportation::whereIn('id', $ids)->get();

            foreach ($transportations as $transportation) {
                $transportation->delete();
            }

            return $this->sendResponse(true);
        }
        return $this->sendResponse(false);
    }
}
