<?php

namespace App\TaskSearch\Filters;

use Illuminate\Database\Eloquent\Builder;

class IsChecked implements Filter
{
	public static function apply(Builder $builder, $value)
	{
		return $builder->where('is_checked', $value);
	}
}

?>