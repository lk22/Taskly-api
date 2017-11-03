<?php

namespace Taskly;

use Illuminate\Database\Eloquent\Model;

use Taskly\User;
use Taskly\Task;

class TaskList extends Model
{
	/**
	 * allowed fields to be fillable
	 * @var [type]
	 */
    protected $fillable = [
    	'name',
        'slug',
    	'user_id'
    ];

    /**
     * fields that are hidden
     * @var array
     */
    protected $hidden = [ 
        'user_id'
    ];

    /**
     * tasklist belongs to user
     * @return [type] [description]
     */
    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    /**
     * tasklist has many tasks
     * @return [type] [description]
     */
    public function tasks()
    {
    	return $this->hasMany(Task::class);
    }
}
