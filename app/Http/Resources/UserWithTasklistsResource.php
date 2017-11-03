<?php

namespace Taskly\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class UserWithTasklistsResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        
        $this->resource->load('tasklists');

        return $this->resource->map(function ($user) {
            return [
                'firstname' => $user->firstname,
                'lastname' => $user->lastname,
                'slug' => $user->slug,
                'email' => $user->email,
                // 'tasklists' => new TasklistResource($user->tasklists)
            ];
        });
    }
}
