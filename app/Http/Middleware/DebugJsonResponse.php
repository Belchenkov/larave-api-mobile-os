<?php
/**
 * Created by black40x@yandex.ru
 * Date: 24/09/2019
 */

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;

class DebugJsonResponse
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
        $response = $next($request);

        if (
            $response instanceof JsonResponse &&
            config('app.debug') &&
            app()->bound('debugbar') &&
            app('debugbar')->isEnabled() &&
            is_object($response->getData())
        ) {
            $response->setData($response->getData(true) + [
                'debug' => [
                    'queries' => app('debugbar')->getData()['queries']['nb_statements'],
                    'queries_time' => app('debugbar')->getData()['queries']['accumulated_duration_str'],
                ]
            ]);
        }

        return $response;
    }
}
