<?php

namespace Taskly;

use Illuminate\Database\Eloquent\Model;
use Taskly\Task;

class Placement extends Model
{
    /**
     * fields that mass assignable
     * @var [type]
     */
    protected $fillable = [
    	'name',
    	'task_id',
    	'streetname',
    	'city_code',
    	'city'
    ];

    /**
     * hidden fields
     * @var [type]
     */
    protected $hidden = [
    	'task_id'
    ];

    /**
     * placement belongs to a task
     * @return [type] [description]
     */
    public function task()
    {
    	return $this->belongsTo(Task::class);
    }
}
