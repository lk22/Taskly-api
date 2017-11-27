<?php

namespace Taskly;

use Illuminate\Database\Eloquent\Model;

use Taskly\User;
use Taskly\TaskList;

class Task extends Model
{
    /**
     * column fields allowed to be fillable
     * @var [type]
     */
    protected $fillable = [
        'name',
        'slug',
        'user_id',
        'task_list_id',
        'is_checked',
        'priority'
    ];

    /**
     * fields to be hidden
     * @var [type]
     */
    protected $hidden = [
        'user_id',
        'task_list_id'
    ];

    /**
     * define castable columns to be specific datatype in return
     * @var [type]
     */
    protected $casts = [
        'is_checked' => 'boolean',
    ];

    /**
     * task belongs to user
     * @return [type] [description]
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * task belongs to tasklist
     * @return [type] [description]
     */
    public function tasklist()
    {
        return $this->belongsTo(TaskList::class);
    }
}
