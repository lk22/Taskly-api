<?php

namespace Taskly;

use Illuminate\Database\Eloquent\Model;

use Taskly\User;
use Taskly\Comment;

class Task extends Model
{
    /**
     * |-------------------------------------------
     * |
     * |   the mass-assignable field to be filled
     * |
     * |-------------------------------------------
     */
    protected $fillable = [
        'slug',
        'user_id',
        'is_checked',
        'priority',
        'work_hours',
        'start_at',
        'end_at',
        'supplier',
        'location'
    ];

    /**
     * |-------------------------------------------
     * |
     * |    fields to be hidden
     * |
     * |-------------------------------------------
     */
    protected $hidden = [
        'user_id',
    ];

   /**
     * |-------------------------------------------
     * |
     * |    Special casting property
     * |
     * |-------------------------------------------
     */
    protected $casts = [
        'is_checked' => 'boolean',
    ];

    /**
     * |-------------------------------------------
     * |
     * |    extending default behavior
     * |
     * |-------------------------------------------
     */
    protected static function boot() {
        parent::boot();

        // while deleting model
        static::deleting(function($task) {
            return $task->comments()->delete();
        });
    }

    /**
     * |-------------------------------------------
     * |
     * |   Tasks belongs to a user
     * |
     * |-------------------------------------------
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * |-------------------------------------------
     * |
     * |    Tasks has many comments
     * |
     * |-------------------------------------------
     */
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
