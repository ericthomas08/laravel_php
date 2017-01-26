<?php

namespace App\Http\Middleware;

use Closure, Session, Redirect;

class CheckCustomerAuth
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
        if (!Session::has('customer_id')) {
            return Redirect::route('customer.auth.login');
        }
        return $next($request);
    }
}
