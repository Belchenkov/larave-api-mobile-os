<?php

namespace App\Http\Middleware\Api;


use App\Exceptions\Api\ApiAuthorizationException;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class AuthenticatedMiddleware extends Middleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            throw new ApiAuthorizationException();
        }
    }
}
