<?php

namespace Taskly\Transformers;

use League\Fractal\TransformerAbstract;

use Taskly\User;

class UsersTransformer extends TransformerAbstract
{

    protected $defaultIncludes = [
        'tasks'
    ];

    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(User $user)
    {
        return [
            'id' => (int) $user->id,
            'firstname' => (string) $user->firstname,
            'lastname' => (string) $user->lastname,
            'fullname' => (string) $user->firstname . ' ' . $user->lastname,
            'email' => (string) $user->email,
            'is_admin' => (boolean) $user->is_admin
        ];
    }

    public function includeTasks(User $user)
    {
        return ($user->tasks)
        ? $this->collection($user->tasks, app()->make(TasksTransformer::class))
        : null;
    }
}
