<?php

namespace Taskly\Transformers;

use League\Fractal\TransformerAbstract;

use Taskly\Transformers\TaskListTransformer;

use Taskly\User;

class UserTransformer extends TransformerAbstract
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
            'id'            => (int) $user->id,
            'firstname'     => (string) $user->firstname,
            'lastname'      => (string) $user->lastname,
            'fullname'      => (string) $user->firstname . ' ' . $user->lastname,
            'slug'          => (string) $user->slug,
            'email'         => (string) $user->email,
            'company'       => (object) $user->companies,
            'tasks'         => (object) $user->tasks
        ];
    }

    public function includeTasks(User $user)
    {
        return ($user->tasklists)
        ? $this->collection($user->tasklists, app()->make(TasksTransformer::class))
        : null;
    }

    public function includeCompanies(User $user)
    {
        return ($user->companies)
        ? $this->collection($user->companies, app()->make(CompanyTransformer::class))
        : null;
    }
}