<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateTagRequest;
use App\Http\Requests\UpdateTagRequest;
use App\Http\Resources\Admin\TagResource;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
class TagController extends Controller
{
    public function create(CreateTagRequest $request): JsonResponse
    {
        Tag::create($request->all());

        return $this->sendResponse(true);
    }

    public function update(UpdateTagRequest $request, $id): JsonResponse {
        $tag = Tag::findOrFail($id);
        $tag->update($request->all());

        return $this->sendResponse(true);
    }

    public function find($id): TagResource {
        return new TagResource(Tag::findOrFail($id));
    }

    public function search(Request $request): AnonymousResourceCollection {
        $search = $request['search'];
        $orderByName = $request['orderByName'];
        $orderBy = $request['orderBy'];
        $perPage = $request['perPage'];
        $pageNumber = $request['pageNumber'];

        $tags = Tag::query();

        if(!empty($search)) {
            $tags = $tags->where('name', 'Like', `%{$search}%`);
        }

        $tags = $tags->orderBy($orderByName, $orderBy)->paginate($perPage, ['*'], 'page', $pageNumber);

        return TagResource::collection($tags);
    }

    public function changeStatus(Request $request): JsonResponse
    {
        $ids = $request['ids'];
        $status = $request['status'];

        if(!empty($ids)) {
            $tags = Tag::whereIn('id', $ids)->get();

            foreach ($tags as $tag) {
                $tag->update([
                    'status' => $status
                ]);
            }
            return  $this->sendResponse(true);
        }

        return  $this->sendResponse(false);

    }

    public function delete($id): JsonResponse
    {
        $tag = Tag::findOrFail($id);

        $tag->delete();

        return $this->sendResponse(true);
    }

    public function multipleDelete(Request $request): JsonResponse
    {
        $ids = $request['ids'];

        if(!empty($ids)) {
            $tags = Tag::whereIn('id', $ids)->get();

            foreach ($tags as $tag) {
                $tag->delete();
            }

            return $this->sendResponse(true);
        }
        return $this->sendResponse(false);
    }
}
