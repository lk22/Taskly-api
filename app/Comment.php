<?php

namespace Taskly;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    /**
     * |-------------------------------------------
     * |
     * | The required table to use
     * |
     * |-------------------------------------------
     */
    protected $table = 'comment_task';

    /**
     * |-------------------------------------------
     * |
     * | the mass-assignable field to be filled
     * |
     * |-------------------------------------------
     */
    protected $fillable = array(
    	'body'
    );

    /**
     * |-------------------------------------------
     * |
     * | Fields to hide in the manipulation
     * |
     * |-------------------------------------------
     */
    protected $hidden = array('id');

    /**
     * |-------------------------------------------
     * |
     * |	make them commentable
     * |
     * |-------------------------------------------
     */
    public function commentable()
    {
    	return $this->morphTo();
    }
}
