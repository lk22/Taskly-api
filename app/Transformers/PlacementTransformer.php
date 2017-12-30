<?php

namespace Taskly\Transformers;

use League\Fractal\TransformerAbstract;

use Taskly\Transformers\TaskTransformer;

use Taskly\Placement;

class PlacementTransformer extends TransformerAbstract
{
    protected $defaultIncludes = [
        'task'
    ];

    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Placement $placement)
    {
        return [
            'id'            => (int) $placement->id,
            'name'          => (string) $placement->name,
            'streetname'    => (string) $placement->streetname,
            'city_code'     => (string) $placement->city_code,
            'city'          => (string) $placement->city
        ];
    }

    public function includeTask(Placement $placement)
    {
        return ($placement->task)
        ? $this->item($placement->task, app()->make(TaskTransformer::class))
        : null;
    }
}
