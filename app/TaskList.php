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
     * Automatically boot method
     */
    protected static function boot() {
        parent::boot();
        
        /**
         * on deleting state
         */
        static::deleting(function($tasklist) {
            $tasklist->tasks()->delete();
        });
    }

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

    /**
     * order all the tasklists with descending order
     * @param  [type] $query [description]
     * @return [type]        [description]
     */
    public function scopeDescending($query)
    {
        return $query->orderBy('id', 'DESC');
    }

    /**
     * order all the tasklists with ascending order
     * @param  [type] $query [description]
     * @return [type]        [description]
     */
    public function scopeAscending($query)
    {
        return $query->orderBy('id', 'ASC');
    }
}
