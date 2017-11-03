<?php

namespace Taskly\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class TasklistResource extends Resource
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
            'name' => $this->name,
            'slug' => $this->slug,
            'tasks' => optional(TaskResource::collection($this->tasks))
        ];
    }
}
