<?php

namespace App\Http\Middleware;

use Closure;

class NewUserRegistration
{
    public function handle($request, Closure $next)
    {
        if ($request->user()->signup_complete == false)
        {
            return redirect('/user/register');
        }

        return $next($request);
    } // end handle

} // end NewUserRegistration
