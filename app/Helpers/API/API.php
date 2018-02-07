<?php

namespace Taskly\Helpers\API;

use \Response;
use Illuminate\Http\Request;

use Exception;

/**
* API Helper class for development mode
*/
class API
{

   /**
    * |------------------------------------------------------
    * |
    * | Show dumped query string if the environment is local
    * |
    * |------------------------------------------------------
    */
    public static function queryString($query)
    {
        if (app()->environment() === 'environment') {
            return $query->toSql();
        }
    }

    /**
    * |------------------------------------------------------
    * |
    * | Validation helper for api requests
    * |
    * |------------------------------------------------------
    */
    public static function validate($request, $rules = [])
    {
        if($request instanceOf Request){
             $request->validate($rules);
        }

        return new Exception('Could not validate request', 1);
    }

    /**
    * |------------------------------------------------------
    * |
    * | Throw action success response 
    * |
    * |------------------------------------------------------
    */
    public static function throwActionSuccessResponse($response)
    {
        return Response::json([
            'response' => $response
        ]);
    }

    /**
    * |------------------------------------------------------
    * |
    * | Throw Resource created response
    * |
    * |------------------------------------------------------
    */
    public static function throwResourceCreatedResponse($resource)
    {

        if(!$resource) {
            return static::throwResourceNotFoundException();
        }

        return Response::json([
            'response' => 'Resource ' . $resource .' created successfully'
        ], 201);
    }

    /**
    * |------------------------------------------------------
    * |
    * | throw an 422 exception 
    * |
    * |------------------------------------------------------
    */
    public static function throwActionFailedException($exception)
    {
        return Response::json([
            'response' => 'Action: ' . $exception . ' failed.'
        ], 422);
    }

    /**
    * |------------------------------------------------------
    * |
    * | throw 404 exception if the resource not exists
    * |
    * |------------------------------------------------------
    */
    public static function throwResourceNotFoundException()
    {
        return Response::json([
            'message' => "Your request dosen't contain any resources"
        ], 404);
    }

    /**
    * |------------------------------------------------------
    * |
    * | throw request not found exception
    * |
    * |------------------------------------------------------
    */
    public static function throwRequestNotFoundException()
    {
        return Response::json([
            'message' => 'Your request could not be found try again'
        ], 300);
    }

    /**
    * |------------------------------------------------------
    * |
    * | throw input not found exception
    * |
    * |------------------------------------------------------
    */
    public static function throwInputNotFoundException()
    {
        return Response::json([
            'message' => 'Could not get data from request'
        ], 422);

        /**
         * if running tests on call
         */
        if (app()->environment() === 'testing') {
            dd('Could not get data from request');
        }
    }
}
