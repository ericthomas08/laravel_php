<?php

namespace App\Http\Middleware;

use Closure, Session, Redirect;

class CheckAdminAuth
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
        if (!Session::has('admin_id')) {
            return Redirect::route('admin.auth.login');
        }

        return $next($request);
    }
}
