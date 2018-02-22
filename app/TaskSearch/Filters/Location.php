<?php

namespace Taskly\TaskSearch\Filters;

class Location implements Filter
{
	public static function apply($builder, $value)
	{
		return $builder->where('location', $value);
	}
}