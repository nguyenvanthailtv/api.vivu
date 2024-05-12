<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateTypeRequest;
use App\Http\Requests\UpdateTypeRequest;
use App\Http\Resources\Admin\TypeResource;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
class TypeController extends Controller
{
    public function all(Request $request): AnonymousResourceCollection
    {
        $orderByName = $request['orderByName'];
        $orderBy = $request['orderBy'];
        $perPage = $request['perPage'];
        $pageNumber = $request['pageNumber'];
        $types = Type::orderBy($orderByName, $orderBy)->paginate($perPage, ['*'], 'page', $pageNumber);

        return TypeResource::collection($types);
    }

    public function find($id): TypeResource {
        return new TypeResource(Type::findOrFail($id));
    }

    public function create(CreateTypeRequest $request): JsonResponse
    {
        $type = Type::create($request->all());

        if($request->hasFile('image')) {
            $type->addMedia($request->file('image'))->toMediaCollection('featureImage');
        }

        return $this->sendResponse(true);
    }

    public function update(UpdateTypeRequest $request, $id): JsonResponse {
        $type = Type::findOrFail($id);
        $type->update($request->all());

        if($request->hasFile('image')) {
            $type->addMedia($request->file('image'))->toMediaCollection('featureImage');
        }

        return $this->sendResponse(true);
    }

    public function delete($id): JsonResponse {
        $type = Type::findOrFail($id);
        $type->clearMediaCollection('featureImage')->delete();

        return $this->sendResponse(true);
    }

    public function search(Request $request): AnonymousResourceCollection{
        $search = $request['search'];
        $orderByName = $request['orderByName'];
        $orderBy = $request['orderBy'];
        $perPage = $request['perPage'];
        $pageNumber = $request['pageNumber'];

        $types = Type::query();

        if(!empty($search)) {
            $types = $types->where('name', 'like',`%{$search}%` );
        }

        $types = $types->orderBy($orderByName, $orderBy)->paginate($perPage, ['*'], 'page', $pageNumber);

        return TypeResource::collection($types);
    }

    public function changeStatus(Request $request): JsonResponse {
        $ids = $request['ids'];
        $status = $request['status'];

        if(!empty($ids)) {
            $types = Type::whereIn('id', $ids)->get();
            foreach ($types as $type) {
                $type->update([
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
            $types = Type::whereIn('id', $ids)->get();

            foreach ($types as $type) {
                $type->clearMediaCollection('featureImage')->delete();
            }

            return $this->sendResponse(true);
        }
        return $this->sendResponse(false);
    }
}
