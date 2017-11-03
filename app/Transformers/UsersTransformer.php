<?php

namespace Taskly\Transformers;

use League\Fractal\TransformerAbstract;

use Taskly\User;

class UsersTransformer extends TransformerAbstract
{

    protected $defaultIncludes = [
        'tasklists'
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

    public function includeTasklists(User $user)
    {
        return ($user->tasklists)
        ? $this->collection($user->tasklists, app()->make(TaskListsTransformer::class))
        : null;
    }
}
