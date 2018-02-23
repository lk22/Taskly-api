<?php

namespace Taskly\Search;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

use Taskly\Task;

class TaskSearch 
{

	/**
     * |-------------------------------------------
     * |
     * | Applying task searching filters
     * |
     * |-------------------------------------------
     */
	public static function apply(Request $filters) {
		$query = static::applyDecoratorsFromRequest($filters, (new Task)->newQuery());

		return static::getResults($query);
	}

	/**
     * |-------------------------------------------
     * |
     * | Applying specific decorators from each request
     * |
     * |-------------------------------------------
     */
	private static function applyDecoratorsFromRequest(Request $request, Builder $query)
	{
		foreach($request->all() as $filterName => $value) {
			$decorator = static::createFilterDecorator($filterName);
			
			if(static::isValidDecorator($decorator)) {
				$query = $decorator::apply($query, $value);
			}
		}
	}

	/**
     * |-------------------------------------------
     * |
     * | Creating filter decorator
     * |
     * |-------------------------------------------
     */
	private static function createFilterDecorator($name) 
	{
		return __NAMESPACE__ . '\\Filters\\' . str_replace(' ', '', ucwords(str_replace('_', ' ', $name)));
	}

	/**
     * |-------------------------------------------
     * |
     * | Validating the decorator
     * |
     * |-------------------------------------------
     */
	private static function isValidDecorator($decorator)
	{
		return class_exists($decorator);
	}

	/**
     * |-------------------------------------------
     * |
     * | Fetching the searching results
     * |
     * |-------------------------------------------
     */
	private static function getResults(Builder $query)
	{
		return $query->get();
	}

}