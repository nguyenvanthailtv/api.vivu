<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateFAQRequest;
use App\Http\Requests\UpdateFAQRequest;
use App\Http\Resources\Admin\FAQResource;
use App\Models\FAQs;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\JsonResponse;
class FAQController extends Controller
{
    public function all(Request $request): AnonymousResourceCollection
    {
        $orderByName = $request['orderByName'];
        $orderBy = $request['orderBy'];
        $perPage = $request['perPage'];
        $pageNumber = $request['pageNumber'];
        $FAQs = FAQs::orderBy($orderByName, $orderBy)->paginate($perPage, ['*'], 'page', $pageNumber);

        return FAQResource::collection($FAQs);
    }

    public function find($id): FAQResource
    {
        return new FAQResource( FAQs::findOrFail($id));
    }

    public function create(CreateFAQRequest $request): JsonResponse
    {
        $FAQ = FAQs::create($request->all());
        return $this->sendResponse(true);
    }

    public function update(UpdateFAQRequest $request, $id): JsonResponse
    {
        $FAQ = FAQs::findOrFail($id);

        $FAQ->update($request->all());

        return $this->sendResponse(true);
    }

    public function delete($id): JsonResponse
    {
        $FAQ = FAQs::findOrFail($id);

        $FAQ->delete();

        return $this->sendResponse(true);
    }

    public function search(Request $request): AnonymousResourceCollection
    {
        $search = $request['search'];
        $orderByName = $request['orderByName'];
        $orderBy = $request['orderBy'];
        $perPage = $request['perPage'];
        $pageNumber = $request['pageNumber'];
        $FAQs = FAQs::query();

        if(!empty($search)) {
            $FAQs = $FAQs->where('title', 'like', `%{$search}%`);
        }

        $FAQs = $FAQs->orderBy($orderByName, $orderBy)->paginate($perPage, ['*'], 'page', $pageNumber);
        return FAQResource::collection($FAQs);
    }

    public function changeStatus(Request $request): JsonResponse
    {
        $ids = $request['ids'];
        $status = $request['status'];

        if(!empty($ids)) {
            $FAQs = FAQs::whereIn('id', $ids)->get();

            foreach ($FAQs as $FAQ) {
                $FAQ->update([
                    'status' => $status
                ]);
            }

            return  $this->sendResponse(true);
        }

        return $this->sendResponse(false);
    }

    public function multipleDelete(Request $request): JsonResponse
    {
        $ids = $request['ids'];

        if(!empty($ids)) {
            $FAQs = FAQs::whereIn('id', $ids)->get();

            foreach ($FAQs as $FAQ) {
                $FAQ->delete();
            }

            return $this->sendResponse(true);
        }
        return $this->sendResponse(false);
    }
}
