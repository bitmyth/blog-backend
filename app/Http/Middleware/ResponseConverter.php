<?php

namespace App\Http\Middleware;

use Closure;

class ResponseConverter
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        if ($request->wantsJson()) {
            if ($response->isSuccessful()) {
                if ($request->isMethod('delete')) {
                    $response->setStatusCode(204);
                }
            }
        }

        return $response;
    }
}
