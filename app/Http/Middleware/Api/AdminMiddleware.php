<?php

namespace App\Http\Middleware\Api;

use App\Exceptions\Api\ApiAuthorizationException;
use Closure;

/**
 * Class ProtectedCallbacks
 * @package App\Http\Middleware\Api
 * Protected Route Callbacks
 */
class AdminMiddleware
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
        if ($request->user('api') && $request->user('api')->is_admin) {
            return $next($request);
        }

        throw new ApiAuthorizationException();
    }
}
