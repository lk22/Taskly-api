<?php

namespace Taskly\Http\Controllers;

use Illuminate\Http\Request;

use Taskly\Transformers\PlacementTransformer;

use Taskly\Placement;

class PlacementController extends Controller
{
    public function __construct(Placement $placement)
    {
    	$this->placement = $placement;
    }

    public function index()
    {

    }

    public function placement($slug)
    {
    	return fractal(
    		$this->placement->with('task')->whereSlug($slug)->first(),
    		new PlacementTransformer()
    	)->toArray();
    }
}
