<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class IdeaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'slug' => $this->slug,
            'created_at' => $this->created_at,
            'description' => $this->description,
            'title' => $this->title,
            'user' => [
                'id' => $this->user_id,
                'avatar_url' => $this->user->getAvatar(),
            ]
        ];
    }
}
