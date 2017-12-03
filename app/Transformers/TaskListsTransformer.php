<?php

namespace Taskly\Transformers;

use League\Fractal\TransformerAbstract;

use Taskly\TaskList;

class TaskListsTransformer extends TransformerAbstract
{
    protected $defaultIncludes = [
        'tasks'
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
            'tasks_count' => (int) $tasklist->tasks->count(),
            'created_at' => (string) trans($tasklist->created_at->diffForHumans(), [], 'dk')
        ];
    }

    public function includeTasks(TaskList $tasklist)
    {
        return ($tasklist->tasks)
        ? $this->collection($tasklist->tasks, app()->make(TasksTransformer::class))
        : null;
    }
}
