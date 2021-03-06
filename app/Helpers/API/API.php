<?php

namespace Taskly\Helpers\API;

use \Response;
use Illuminate\Http\Request;

/**
* API Helper class for development mode
*/
class API
{

    /**
     * only return raw query string but only works in development environmet
     * @param  [type] $query [description]
     * @return [type]        [description]
     */
    public static function queryString($query)
    {
        if (app()->environment() === 'development') {
            return $query->toSql();
        }
    }

    /**
     * validation helper for requests
     */
    public static function validate(Request $request, $rules = [])
    {
        $request->validate($rules);
    }

    public static function throwActionSuccessResponse($response)
    {
        return Response::json([
            'response' => $response
        ]);
    }

    public static function throwActionFailedException($exception)
    {
        return Response::json([
            'response' => $exception
        ]);
    }

    /**
     * if a resource is not found
     */
    public static function throwResourceNotFoundException()
    {
        return Response::json([
            'message' => "Your request dosen't contain any resources"
        ], 404);
    }

    /**
     * if the request dont have any data
     */
    public static function throwRequestNotFoundException()
    {
        return Response::json([
            'message' => 'Your request could not be found try again'
        ], 300);
    }

    /**
     * if a input is not found
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
