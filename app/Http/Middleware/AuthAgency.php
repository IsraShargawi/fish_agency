<?php

namespace App\Http\Middleware;

use Closure;

class AuthAgency
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
        if (session()->get('agency')) {
            return $next($request);
        }
        return redirect('/agency-dashboard/login');
    }
}
