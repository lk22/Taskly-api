<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\TestResponse;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * define test response
     * @return  Illuminate\Foundation\Testing\TestResponse::class
     * @var [type]
     */
    protected $testResponse;

    /**
     * getting response from a specific route
     * @param  string $route [description]
     * @return [type]        [description]
     */
    protected function getResponseFrom($route = '/')
    {
    	$call = $this->get($route);
    	$this->testResponse = new TestResponse($call);
    	return $this;
    }

    /**
     * with a specific view
     * @param  [type] $view [description]
     * @param  [type] $data [description]
     * @return [type]       [description]
     */
    protected function withView($view, $data = null) {
    	$this->testResponse->assertViewIs($view);
    	return $this;
    }

    /**
     * and the data from the view
     * @param  [type] $data [description]
     * @return [type]       [description]
     */
    protected function andViewData($data = null){
    	$this->testResponse->assertViewHas($data);
    	return $this;
    }

    /**
     * create fake data to use in test
     * @param  [type] $model   [description]
     * @param  array  $columns [description]
     * @param  [type] $times   [description]
     * @return [type]          [description]
     */
    protected function make(
        $model,
        $columns = [],
        $times = 1
    ){
    	$factory = ($times > 1)
        ? factory($model, $times)->create()
        : factory($model)->create($columns);
    	return $factory;
    }
}
