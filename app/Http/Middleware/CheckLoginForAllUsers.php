<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

 //this middleware is for checking login for guard users like member,provider so that member routes can be accessed onky if member is login and same for provider
class CheckLoginForAllUsers                                    
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next,$guard_user_type)
    {
        if(Auth::check())                            //if admin is login then stop accessing guard users pages
            return redirect('/');
        elseif(Auth::guard($guard_user_type)->check())    
            return $next($request);
        else
            return redirect('/');   

    }
}
