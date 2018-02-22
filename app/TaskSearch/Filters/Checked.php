<?php

namespace App\TaskSearch\Filters;

class Checked implements Filter
{
	public static function apply($builder, $value)
	{
		return $builder->where('is_checked', $value);
	}
}

?>