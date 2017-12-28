<?php

namespace Taskly;

use Illuminate\Database\Eloquent\Model;

use Taskly\User;
use Taskly\Placement;

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
        'priority',
        'work_hours',
        'start_at',
        'end_at',
        'supplier',
        'location'
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
     * Automatic boot function
     */
    protected static function boot() {
        parent::boot();

        static::deleting(function($task) {
            return $task->placements()->delete();
        });
    }

    /**
     * task belongs to user
     * @return [type] [description]
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * task
     * @return [type] [description]
     */
    public function placements()
    {
        return $this->hasMany(Placement::class);
    }
}
