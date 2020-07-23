<?php

namespace App\Http\Middleware;

use Auth;
use Session;
use Closure;

class Dashboard
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
        $user = auth()->user();

        if($user->role_id !== 1) {
            return $next($request);
        }else {
            Session::flash('error', 'You do not have permission for this action.');
            return redirect()->route('website');
        }
    }
}
