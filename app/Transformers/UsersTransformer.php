<?php

namespace Taskly\Transformers;

use League\Fractal\TransformerAbstract;

use Taskly\User;

class UsersTransformer extends TransformerAbstract
{

    protected $defaultIncludes = [
        'companies',
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
            'email'         => (string) $user->email
        ];
    }

    /**
     * include companies data to the user transformation
     * @param  User   $user [description]
     * @return [type]       [description]
     */
    public function includeCompanies(User $user)
    {
        return ($user->companies)
        ? $this->collection($user->companies, app()->make(CompanyTransformer::class))
        : null;
    }

    /**
     * include users tasks to the user transformation
     * @param  User   $user [description]
     * @return [type]       [description]
     */
    public function includeTasks(User $user)
    {
        return ($user->tasks)
        ? $this->collection($user->tasks, app()->make(TasksTransformer::class))
        : null;
    }

    
}
