<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ExerciseBookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => str_limit($this->description),
            'price' => $this->price,
            'created_at' => $this->created_at->toDateTimeString(),
            'updated_at' => $this->updated_at->toDateTimeString(),
            'section' => SectionResource::make($this->whenLoaded('section')),
            'questions_count' => $this->when($this->relationLoaded('questions'), function () {
                return count($this->questions);
            }),
            'has_bought' => (boolean) $this->hasBought()
        ];
    }
}
