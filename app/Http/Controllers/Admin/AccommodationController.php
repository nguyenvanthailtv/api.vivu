<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateAccommodationRequest;
use App\Http\Requests\UpdateAccommodationRequest;
use App\Http\Resources\Admin\AccommodationResource;
use App\Models\Accommodation;
use http\Env\Response;
use Illuminate\Http\Request;

class AccommodationController extends Controller
{
    public function create(CreateAccommodationRequest $request): AccommodationResource
    {
        $accommodation = Accommodation::create($request->all());
        return new AccommodationResource($accommodation);
    }

    public function update(UpdateAccommodationRequest $request, $id)
    {
        $accommodation = Accommodation::find($id);
        if(empty($accommodation)) {
            return response()->json([
                'data' => [
                    'success' => false,
                ]
            ]);
        }
        $accommodation->update($request->all());

        return new AccommodationResource($accommodation);
    }

    public function find($id)
    {
        $accommodation = Accommodation::find($id);

        if(empty($accommodation)) {
            return response()->json([
                'data' => [
                    'success' => false,
                ]
            ]);
        }
        return new AccommodationResource($accommodation);
    }

    public function search(Request $request) {
        $search = $request->search;
        $orderByName = $request->orderByName;
        $orderBy = $request->orderbBy;
        $perPage = $request->perPage;
        $pageNumber = $request->pageNumber;
        $accommodations = Accommodation::query();
        if(!empty($search)) {
            $accommodations = Accommodation::where('title' , 'Like', `%{$search}%`);
        }
        $accommodations = $accommodations->orderBy($orderByName, $orderBy)->paginate($perPage, ['*'], 'page', $pageNumber);

        return AccommodationResource::collection($accommodations);
    }

    public function all(Request $request) {
        $orderByName = $request->orderByName;
        $orderBy = $request->orderbBy;
        $perPage = $request->perPage;
        $pageNumber = $request->pageNumber;
        $accommodations = Accommodation::orderBy($orderByName, $orderBy)->paginate($perPage, ['*'], 'page', $pageNumber);
        return AccommodationResource::collection($accommodations);
    }

    public function changeStatus(Request $request) {
        $ids = $request->ids;
        $status = $request->status;

        if(!empty($ids)) {
            $accommodations = Accommodation::whereIn('id', $ids)->get();

            foreach ($accommodations as $accommodation) {
                $accommodation->update([
                    'status' => $status
                ]);
            }

            return response()->json([
                'data' => [
                    'success' => true,
                ]
            ]);
        }

        return response()->json([
            'data' => [
                'success' => false,
            ]
        ]);
    }

    public function delete($id) {
        $accommodation = Accommodation::find($id);

        if(empty($accommodation)) {
            return response()->json([
                'data' => [
                    'success' => false,
                ]
            ]);
        }

        $accommodation->delete();

        return response()->json([
            'data' => [
                'success' => $accommodation,
            ]
        ]);
    }

    public function multipleDelete(Request $request) {
        $ids = $request->ids;
        $accommodations = Accommodation::whereIn('id', $ids)->get();

        foreach ($accommodations as $accommodation) {
            $accommodation->delete();
        }

        return response()->json([
            'data' => [
                'success' => true,
            ]
        ]);
    }
}
