<?php

namespace Taskly\Transformers;

use League\Fractal\TransformerAbstract;

use Taskly\Task;

class TasksTransformer extends TransformerAbstract
{

    protected $defaultIncludes = [
        'placements'
    ];

    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Task $task)
    {
        return [
            'id' => (int) $task->id,
            'name' => (string) $task->name,
            'slug' => (string) $task->slug,
            'is_checked' => (boolean) $task->is_checked
        ];
    }

    public function includePlacements(Task $task)
    {
        return ($task->placements)
        ? $this->collection($task->placements, app()->make(PlacementsTransformer::class))
        : null;
    }
}
