<?php

namespace Taskly\Http\Middleware;

use Closure;

class EnforeJson
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $acceptHeader = $request->header('Accept');
        $token = $request->header('Authorization');
        if(\Auth::guard('api')) {
            if($acceptHeader != 'application/json' && !$token) {
                return response()->json([
                    'error' => 'Unauthenticated'   
                ], 400);
            }
        }
        
        return $next($request);
    }
}
