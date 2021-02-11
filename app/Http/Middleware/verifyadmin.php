<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class verifyadmin
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
        if (!Auth::guard('adapi')->user()) {   // Check is admin logged in
            return response()->json(['error' => 'you are not authenticated as admin', 401]);

        }
        return $next($request); 
       // return Auth::guard('adapi');

        
       // return $next($request);

    }
}
