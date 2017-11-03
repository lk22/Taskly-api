<?php

namespace Taskly\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class UserCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
         
        // return [
        //     'id' => $this->id,
        //     'firstname' => $this->firstname,
        //     'lastname' => $this->lastname,
        //     'slug' => $this->slug,
        //     'email' => $this->email,
        //     'tasklists' => optional(new TaskListCollection($this->tasklists))
        // ];
    }
}
