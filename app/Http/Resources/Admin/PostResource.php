<?php

namespace App\Http\Resources\Admin;

use App\Models\Author;
use App\Models\PostCategory;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'postCategory' => $this->postCategory,
            'author' => $this->author,
            'title' => $this->title,
            'slug' => $this->slug,
            'featureImage' => $this->featureImage,
            'tags' => $this->tags,
        ];
    }
}
