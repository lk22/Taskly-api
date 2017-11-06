<?php

namespace Taskly\Http\Controllers;

use Illuminate\Http\Request;

use Taskly\Transformers\UserTransformer;
use Taskly\Transformers\UsersTransformer;

use Taskly\User;

class UserController extends Controller
{
	/**
	 * Constructor
	 * @param User $user [description]
	 */
    public function __construct(User $user)
    {
    	$this->user = $user;
    }

    /**
     * get all users
     * @return [type] [description]
     */
    public function index()
    {
        return fractal(
            $this->user->all(),
            new UsersTransformer()
        )->toArray();
    }

    /**
     * get single user from slug
     * @param  [type] $user_slug [description]
     * @return [type]            [description]
     */
    public function user($user_slug)
    {
    	return fractal(
            $this->user->whereSlug($user_slug)->first(),
            new UserTransformer()
        )->toArray();
    }

    /**
     * fetch user with tasklists
     * @return [type] [description]
     */
    public function userTasklists($user_slug)
    {
        return fractal(
            $this->user->with('tasklists')->whereSlug($user_slug)->first(),
            new UserTransformer()
        )->toArray();

    }

    /**
     * fetch users with tasklists
     * @return [type] [description]
     */
    public function usersTasklists()
    {
        return fractal(
            $this->user->with('tasklists')->get(),
            new UsersTransformer()
        )->toArray();
    }

    /**
     * fetch a user and the users tasklists with tasks
     * @param  [type] $user_slug [description]
     * @return [type]            [description]
     */
    public function userTasklistsTasks($user_slug)
    {
        return fractal(
            $this->user->with('tasklists.tasks')->whereSlug($user_slug)->first(),
            new UserTransformer()
        )->toArray();
    }
}
