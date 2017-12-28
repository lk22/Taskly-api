<?php

namespace Taskly;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Taskly\Task;
use Taskly\Company;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'firstname', 'lastname', 'slug', 'is_admin',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * defining columns to be casted as specific data type
     * @var [type]
     */
    protected $casts = [
        'is_admin' => 'boolean',
        'has_company' => 'boolean'
    ];

    /**
     * user has many tasklists
     * @return [type] [description]
     */
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function companies()
    {
        return $this->hasMany(Company::class);
    }
}
