<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePostCategoryRequest;
use App\Http\Requests\UpdatePostCategoryRequest;
use App\Http\Resources\Admin\PostCategoryResource;
use App\Models\PostCategory;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
class PostCategoryController extends Controller
{
    public function create(CreatePostCategoryRequest $request): JsonResponse
    {
        PostCategory::create($request->all());
        return $this->sendResponse(true);
    }

    public function update(UpdatePostCategoryRequest $request, $id): JsonResponse
    {
        $postCategory = PostCategory::findOrFail($id);

        $postCategory->update($request->all());

        return $this->sendResponse(true);
    }

    public function find($id): PostCategoryResource {
        return new PostCategoryResource(PostCategory::findOrFail($id));
    }

    public function search(Request $request): AnonymousResourceCollection {
        $search = $request['search'];
        $orderByName = $request['orderByName'];
        $orderBy = $request['orderBy'];
        $perPage = $request['perPage'];
        $pageNumber = $request['pageNumber'];
        $postCategories = PostCategory::query();
        if(!empty($search)) {
            $postCategories = $postCategories->where('name', 'like', `{$search}`);
        }
        $postCategories = $postCategories->orderBy($orderByName, $orderBy)->paginate($perPage, ['*'], 'page', $pageNumber);

        return PostCategoryResource::collection($postCategories);
    }

    public function changeStatus(Request $request):JsonResponse {
        $ids = $request['ids'];
        $status = $request['status'];

        if(!empty($ids)) {
            $postCategories = PostCategory::whereIn('id', $ids)->get();

            foreach ($postCategories as $postCategory) {
                $postCategory->update([
                    'status' => $status
                ]);
            }

            return  $this->sendResponse(true);
        }
        return  $this->sendResponse(false);
    }

    public function delete($id): JsonResponse {
        $postCategory = PostCategory::findOrFail($id);
        $postCategory->delete();

        return $this->sendResponse(true);
    }

    public function multipleDelete(Request $request): JsonResponse {
        $ids = $request['ids'];

        if(!empty($ids)) {
            $postCategories = PostCategory::whereIn('id', $ids)->get();

            foreach ($postCategories as $postCategory) {
                $postCategory->delete();
            }
            return $this->sendResponse(true);
        }
        return $this->sendResponse(false);
    }
}
