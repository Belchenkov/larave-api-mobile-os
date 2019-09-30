<?php

namespace App\Http\Middleware\Api;

use App\Exceptions\Api\ApiAuthorizationException;
use Closure;

/**
 * Class ProtectedCallbacks
 * @package App\Http\Middleware\Api
 * Protected Route Callbacks
 */
class ProtectedCallbacks
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
        if ($request->header('x-callback-key') == config('workflow.callback_key')) {
            return $next($request);
        }

        throw new ApiAuthorizationException();
    }
}
