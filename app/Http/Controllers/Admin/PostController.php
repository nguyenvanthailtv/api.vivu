<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Resources\Admin\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
class PostController extends Controller
{
    public function find($id): PostResource {
        return new PostResource(Post::findOrFail($id));
    }

    public function create(CreatePostRequest $request): JsonResponse {
        $post = Post::create($request->all());

        if($request->hasFile('image')) {
            $post->addMedia($request->file('image'))->toMediaCollection('featureImage');
        }

//        $tagIds = $request['tagIds'];
        $tagIds = collect($request['tags'])->pluck('id')->all();
        if(!empty($tagIds)) {
            $post->tags()->sync($tagIds);
        }

        return $this->sendResponse(true);
    }

    public function update(UpdatePostRequest $request, $id): JsonResponse {
        $post = Post::findOrFail($id);
        $post->update($request->all());

        if($request->hasFile('image')) {
            $post->addMedia($request->file('image'))->toMediaCollection('featureImage');
        }

        $tagIds = collect($request['tags'])->pluck('id')->all();

        if(!empty($tagIds)) {
            $post->tags()->sync($tagIds);
        }

        return $this->sendResponse(true);
    }

    public function delete($id): JsonResponse {
        $post = Post::findOrFail($id);
        $post->clearMediaCollection('featureImage')->delete();
        return $this->sendResponse(true);
    }

    public function search(Request $request): AnonymousResourceCollection {
        $search = $request['search'];
        $orderByName = $request['orderByName'];
        $orderBy = $request['orderBy'];
        $perPage = $request['perPage'];
        $pageNumber = $request['pageNumber'];

        $posts = Post::query();

        if(!empty($search)) {
            $posts = $posts->where('title', 'like', `%{$search}%`);
        }

        $posts = $posts->orderBy($orderByName, $orderBy)->paginate($perPage, ['*'], 'page', $pageNumber);
        return PostResource::collection($posts);
    }

    public function changeStatus(Request $request): JsonResponse {
        $ids = $request['ids'];
        $status = $request['status'];
        if(!empty($ids)) {
            $posts = Post::whereIn('id', $ids)->get();

            foreach ($posts as $post) {
                $post->update([
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
            $posts = Post::whereIn('id', $ids)->get();

            foreach ($posts as $post) {
                $post->clearMediaCollection('featureImage');
                $post->delete();
            }
            return $this->sendResponse(true);
        }
        return $this->sendResponse(false);

    }
}
