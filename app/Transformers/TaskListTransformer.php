<?php

namespace Taskly\Transformers;

use League\Fractal\TransformerAbstract;

// single resources transformers
use Taskly\Transformers\TaskTransformer;
use Taskly\Transformers\UserTransformer;

// collection transformers

use Taskly\TaskList;

class TaskListTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'tasks',
        'task',
        'user'
    ];

    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(TaskList $tasklist)
    {
        return [
            'id' => (int) $tasklist->id,
            'name' => (string) $tasklist->name,
            'slug' => (string) $tasklist->slug,
            'created_at' => (string) $tasklist->created_at->diffForHumans()
        ];
    }

    public function includeTasks(TaskList $tasklist)
    {
        return (!$tasklist->tasks)
        ? null
        : $this->collection($tasklist->tasks, App::make(TaskTransformer::class));
    }

    public function includeTask(TaskList $tasklist)
    {
        return (!$tasklist->task)
        ? null
        : $this->item($tasklist->tasks, App::make(TaskTransformer::class));
    }

    public function includeUser(TaskList $tasklist)
    {
        return (!$tasklist->user)
        ? null
        : $this->item($tasklist->user, App::make(UserTransformer::class));
    }
}
