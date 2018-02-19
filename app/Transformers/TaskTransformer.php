<?php

namespace Taskly\Transformers;

use League\Fractal\TransformerAbstract;

use Taskly\Task;

class TaskTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'user'
    ];

    protected $defaultIncludes = [
        'tasklist',
        // 'user',
        // placement
    ];

    /**x++
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Task $task)
    {
        return [
            'id'                => (int)        $task->id,
            'location'          => (string)     $task->location,
            'slug'              => (string)     $task->slug,
            'is_checked'        => (boolean)    $task->is_checked,
            'supplier'          => (string)     $task->supplier,
            'work_hours'        => (string)     $task->work_hours,
            'week_day'          => (string)     $task->week_day,
            'week'              => (int)        $task->week,
            'start_at'          => (string)     $task->start_at,
            'end_at'            => (string)     $task->end_at,
            'comments_counts'   => (int)        count($task->comments),
            'is_weekend'        => (int)        $task->is_weekend
        ];
    }

    // public function includeUser(Task $task)
    // {
    //     return ($task->user)
    //     ? $this->item($task->user, app()->make(UserTransformer::class))
    //     : null;
    // }

    public function includeTasklist(Task $task)
    {
        return ($task->tasklist)
        ? $this->item($task->tasklist, app()->make(TaskListTransformer::class))
        : null;
    }

    //public function includePlacement(Task $task)
    //{
    //    return ($task->placement)
    //    ? $this->item($task->placement, app()->make(PlacementTransformer::class))
    //    : null;
    //}
}
