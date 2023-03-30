<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

//middleware used in member routes,provider routes to check  that if admin is login then admin can not access member routes,provider routes.
//Also for those routes which member or provider can not access if they are login
class IsAdminOrUserLogin 
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
       if(Auth::check() || Auth::guard('member')->check() || Auth::guard('provider')->check())
        return redirect('/'); 
       else
        return $next($request);
    }
}
