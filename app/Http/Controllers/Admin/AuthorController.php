<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateActivityRequest;
use App\Http\Requests\UpdateAuthorRequest;
use App\Http\Resources\Admin\AuthorResource;
use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class AuthorController extends Controller
{
    public function all(Request $request): AnonymousResourceCollection
    {
        $orderByName = $request['orderByName'];
        $orderBy = $request['orderBy'];
        $perPage = $request['perPage'];
        $pageNumber = $request['pageNumber'];
        $activities = Author::orderBy($orderByName, $orderBy)->paginate($perPage, ['*'], 'page', $pageNumber);

        return AuthorResource::collection($activities);
    }

    public function find($id): AuthorResource
    {
        $author = Author::findOrFail($id);
        return new AuthorResource($author);

    }

    public function create(CreateActivityRequest $request): JsonResponse
    {
        $author = Author::create($request->all());
        if($request->hasFile('image')) {
            $author->addMedia($request->file('image'))->toMediaCollection('featureImage');
        }

        return $this->sendResponse(true);
    }

    public function update(UpdateAuthorRequest $request, $id): JsonResponse
    {
        $author = Author::findOrFail($id);
        $author->update($request->all());
        if($request->hasFile('image')) {
            $author->addMedia($request->file('image'))->toMediaCollection('featureImage');
        }

        return $this->sendResponse(true);
    }

    public function delete($id): JsonResponse
    {
        $author = Author::findOrFail($id);

        $author->clearMediaCollection('featureImage')->delete();

        return $this->sendResponse(true);
    }

    public function search(Request $request): AnonymousResourceCollection
    {
        $search = $request['search'];
        $orderByName = $request['orderByName'];
        $orderBy = $request['orderBy'];
        $perPage = $request['perPage'];
        $pageNumber = $request['pageNumber'];
        $authors = Author::query();

        if(!empty($search)) {
            $authors = $authors->where('name', 'like', `%{$search}%`);
        }

        $authors = $authors->orderBy($orderByName, $orderBy)->paginate($perPage, ['*'], 'page', $pageNumber);
        return AuthorResource::collection($authors);
    }

    public function changeStatus(Request $request): JsonResponse
    {
        $ids = $request['ids'];
        $status = $request['status'];

        if(!empty($ids)) {
            $authors = Author::whereIn('id', $ids)->get();

            foreach ($authors as $author) {
                $author->update([
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
            $authors = Author::whereIn('id', $ids)->get();

            foreach ($authors as $author) {
                $author->clearMediaCollection('featureImage')->delete();
            }

            return $this->sendResponse(true);

        }
        return $this->sendResponse(false);

    }
}
