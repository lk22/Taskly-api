<?php

namespace Taskly\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class UserResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {

        return [
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'slug' => $this->slug,
            'email' => $this->email,
            'is_admin' => $this->is_admin,
            'tasklists' => optional(TasklistResource::collection($this->tasklists))
        ];
    }
}
