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
        //Note that User is eager loaded in the controller
        $enrolledUser = $this->users->firstWhere('id', $userId);
        $dateEnrolled = $enrolledUser ? $enrolledUser->pivot->created_at : null;
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'text' => $this->text,
            'date_enrolled' => $dateEnrolled,
        ];
    }
}
