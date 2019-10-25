<?php

namespace App\Http\Middleware\Api;

use App\Exceptions\Api\ApiAuthorizationException;
use Closure;
use Symfony\Component\HttpFoundation\IpUtils;
/**
 * @package App\Http\Middleware\Api
 * Protected Route For admins
 */
class LocalProtectMiddleware
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
        $ip_range = explode(',' ,config('workflow.admin_ip_range', ''));

        if (IpUtils::checkIp($request->getClientIp(), $ip_range)) {
            return $next($request);
        }

        throw new ApiAuthorizationException();
    }
}
