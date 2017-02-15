<?php

namespace App\Http\Middleware;

use Closure;

class RedirectIfBanned 
{
    public function handle($request, Closure $next)
    {
        if ($request->user()->banned == true)
        {
            return redirect('/user/suspended');
        }

        return $next($request);
    } // end handle

} // end NewUserRegistration
