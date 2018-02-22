<?php 

namespace Taskly\TaskSearch\Filters;

use Illuminate\Database\Eloquent\Builder;

interface Filter 
{
	/**
	 * Applying filter to search query
	 * @param  Builder $builder [description]
	 * @param  [type]  $value   [description]
	 * @return [type]           [description]
	 */
	public static function apply(Builder $builder, $value);
}