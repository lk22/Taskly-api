<?php

namespace Taskly\Transformers;

use League\Fractal\TransformerAbstract;

use Taskly\Task;

class TasksTransformer extends TransformerAbstract
{
    
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Task $task)
    {
        return [
            'id'            => (int) $task->id,
            'name'          => (string) $task->name,
            'slug'          => (string) $task->slug,
            'is_checked'    => (boolean) $task->is_checked,
            'work_hours'    => (string) $task->work_hours,
            'priority'      => (string) $task->priority,
            'start_at'      => (string) $task->start_at,
            'end_at'        => (string) $task->end_at,
            'deadline'      => (string) $task->deadline,
            'supplier'      => (string) $task->supplier,
        ];
    }
}
