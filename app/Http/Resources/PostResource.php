<?php

namespace App\Http\Resources;

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
//        return parent::toArray($request);
        return [
            'id' => $this->id,
            'title' => $this->title,
            'short_description' => $this->short_description,
            'content' => $this->content,
            'statues_id' => $this->statues_id,
            'visibility' => $this->visibility,
            'user_id' => $this->user_id,
            'category_id' => $this->category_id,
            'featured' => $this->featured,
            'meta_title' => $this->meta_title,
            'meta_description' => $this->meta_description,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'user' => new PostUserResource($this->user),
            'image' => [
                'image' => $this->image->path,
            ],
            'tags' => PostTagResource::collection($this->tags),
        ];
    }
}
