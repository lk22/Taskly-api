<?php

namespace Taskly;

use \Auth;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Taskly\Task;
use Taskly\Company;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    /**
     * |-------------------------------------------------------
     * |   mass assignable field to be assigned in new models
     * |-------------------------------------------------------
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'firstname',
        'lastname',
        'slug',
        'is_admin',
    ];

    /**
     * |---------------------------------------------------
     * |   Hide the fields from the request
     * |---------------------------------------------------
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * |---------------------------------------------------
     * |  specific columns to cast to specific data type
     * |---------------------------------------------------
     */
    protected $casts = [
        'is_admin' => 'boolean',
        'has_company' => 'boolean'
    ];

    /**
     * |---------------------------------------------------
     * |  user has many tasks
     * |---------------------------------------------------
     */
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    /**
     * |---------------------------------------------------
     * |   user has many companies
     * |---------------------------------------------------
     */
    public function companies()
    {
        return $this->hasMany(Company::class);
    }

    /**
     * |---------------------------------------------------
     * |   Get the authenticated user with specific guard
     * |---------------------------------------------------
     */
    public function getAuthenticatedWithGuard($guard) {
        return Auth::guard($guard);
    }
}
