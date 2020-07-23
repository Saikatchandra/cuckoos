<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Cookie;

class CheckReferral
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
        if ($request->has('ref')) {
            $ref = $request->query('ref');
            Cookie::queue(Cookie::make('referrer', $ref, 43200));
        }

        return $next($request);
    }
}
