<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateLanguageRequest;
use App\Http\Requests\UpdateLanguageRequest;
use App\Http\Resources\Admin\LanguageResource;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\JsonResponse;
class LanguageController extends Controller
{
    public function all(Request $request): AnonymousResourceCollection
    {
        $orderByName = $request['orderByName'];
        $orderBy = $request['orderBy'];
        $perPage = $request['perPage'];
        $pageNumber = $request['pageNumber'];
        $languages = Language::orderBy($orderByName, $orderBy)->paginate($perPage, ['*'], 'page', $pageNumber);

        return LanguageResource::collection($languages);
    }

    public function find($id): LanguageResource
    {
        return new LanguageResource(Language::findOrFail($id));
    }

    public function create(CreateLanguageRequest $request): JsonResponse
    {
        $language = Language::create($request->all());

        if($request->hasFile('image')){
            $language->addMedia($request->file('image'))->toMediaCollection('featureImage');
        }

        return $this->sendResponse(true);
    }

    public function update(UpdateLanguageRequest $request, $id): JsonResponse
    {
        $language = Language::findOrFail($id);

        $language->update($request->all());
        if($request->hasFile('image')) {
        $language->addMedia($request->file('image'))
            ->toMediaCollection('featureImage');
        }

        return $this->sendResponse(true);
    }

    public function delete($id) {
        $language = Language::findOrFail($id);

        $language->clearMediaCollection('featureImage')->delete();

        return $this->sendResponse(true);
    }

    public function search(Request $request): AnonymousResourceCollection
    {
        $search = $request['search'];
        $orderByName = $request['orderByName'];
        $orderBy = $request['orderBy'];
        $perPage = $request['perPage'];
        $pageNumber = $request['pageNumber'];
        $languages = Language::query();

        if(!empty($search)) {
            $languages = $languages->where('name', 'like', `%{$search}%`);
        }

        $languages = $languages->orderBy($orderByName, $orderBy)->paginate($perPage, ['*'], 'page', $pageNumber);
        return LanguageResource::collection($languages);
    }

    public function changeStatus(Request $request): JsonResponse
    {
        $ids = $request['ids'];
        $status = $request['status'];

        if(!empty($ids)) {
            $languages = Language::whereIn('id', $ids)->get();

            foreach ($languages as $language) {
                $language->update([
                    'status' => $status
                ]);
            }

            return $this->sendResponse(true);
        }

        return $this->sendResponse(false);
    }

    public function multipleDelete(Request $request) {
        $ids = $request['ids'];
        if(!empty($ids)) {
            $languages = Language::whereIn('id', $ids)->get();

            foreach ($languages as $language) {
                $language->clearMediaCollection('featureImage')->delete();
            }

            return $this->sendResponse(true);
        }
        return $this->sendResponse(false);
    }

}
