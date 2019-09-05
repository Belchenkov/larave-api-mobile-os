<?php

namespace App\Http\Middleware\Api;

use App\Exceptions\Api\ApiGuestException;
use Closure;
use Illuminate\Support\Facades\Auth;

class GuestMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard('api')->check()) {
            throw new ApiGuestException();
        }

        return $next($request);
    }
}
