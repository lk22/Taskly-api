<?php

namespace Taskly\TaskSearch\Filters;

use Illuminate\Database\Eloquent\Builder;

class Location implements Filter
{
	public static function apply(Builder $builder, $value)
	{
		return $builder->where('location', $value);
	}
}