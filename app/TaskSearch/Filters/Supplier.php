<?php

namespace Taskly\TaskSearch\Filters;

class Supplier implements Filter
{
	public static function apply($builder, $value)
	{
		return $builder->where('supplier', $value);
	}
}