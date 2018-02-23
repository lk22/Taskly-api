<?php

namespace Taskly\TaskSearch\Filters;

use Illuminate\Database\Eloquent\Builder;

class Supplier implements Filter
{
	public static function apply(Builder $builder, $value)
	{
		return $builder->where('supplier', $value);
	}
}