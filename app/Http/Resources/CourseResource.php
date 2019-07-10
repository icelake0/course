<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $userId = auth()->user()->id;
        $courseRegistered = $this->users()->where('user_id', $userId)->first();
        $dateEnrolled = $courseRegistered ? $courseRegistered->pivot->created_at : null;
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'text' => $this->text,
            'date_enrolled' => $dateEnrolled,
        ];
    }
}
