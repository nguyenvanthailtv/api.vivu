<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateActivityRequest;
use App\Http\Requests\UpdateActivityRequest;
use App\Http\Resources\Admin\ActivityResource;
use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\JsonResponse;
class ActivityController extends Controller
{
    public function all(Request $request): AnonymousResourceCollection
    {
        $orderByName = $request['orderByName'];
        $orderBy = $request['orderBy'];
        $perPage = $request['perPage'];
        $pageNumber = $request['pageNumber'];
        $activities = Activity::orderBy($orderByName, $orderBy)->paginate($perPage, ['*'], 'page', $pageNumber);

        return ActivityResource::collection($activities);
    }

    public function find($id): ActivityResource {
        return new ActivityResource(Activity::findOrFail($id));
    }

    public function create(CreateActivityRequest $request): JsonResponse
    {
        $activity = Activity::create($request->all());

        if($request->hasFile('image')) {
            $activity->addMedia($request->file('image'))
                ->toMediaCollection('featureImage');
        }
        return $this->sendResponse(true);
    }

    public function update(UpdateActivityRequest $request, $id): JsonResponse {
        $activity = Activity::findOrFail($id);

        $activity->update($request->all());
        if($request->hasFile('image')) {
            $activity->addMedia($request->file('image'))
                ->toMediaCollection('featureImage');
        }

        return $this->sendResponse(true);
    }

    public function delete($id): JsonResponse {
        $activity = Activity::findOrFail($id);
        $activity->clearMediaCollection('featureImage')->delete();

        return $this->sendResponse(true);
    }

    public function search(Request $request): AnonymousResourceCollection
    {
        $search = $request['search'];
        $orderByName = $request['orderByName'];
        $orderBy = $request['orderBy'];
        $perPage = $request['perPage'];
        $pageNumber = $request['pageNumber'];
        $activities = Activity::query();

        if(!empty($search)) {
            $activities = $activities->where('name', 'like', `%{$search}%`);
        }

        $activities = $activities->orderBy($orderByName, $orderBy)->paginate($perPage, ['*'], 'page', $pageNumber);
        return ActivityResource::collection($activities);
    }

    public function changeStatus(Request $request): JsonResponse
    {
        $ids = $request['ids'];
        $status = $request['status'];

        if(!empty($ids)) {
            $activities = Activity::whereIn('id', $ids)->get();

            foreach ($activities as $activity) {
                $activity->update([
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
            $activities = Activity::whereIn('id', $ids)->get();

            foreach ($activities as $activity) {
                $activity->clearMediaCollection('featureImage');
                $activity->delete();
            }

            return $this->sendResponse(true);
        }
        return $this->sendResponse(false);
    }
}
