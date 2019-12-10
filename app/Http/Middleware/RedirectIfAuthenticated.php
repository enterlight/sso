<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Aacotroneo\Saml2\Saml2Auth;
use Illuminate\Support\Facades\URL;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        /****/
        trace("In " . __METHOD__);
        trace("Session in RedirectIfAuthenticated MiddelWare");
        trace(session()->all());

        if (Auth::guest())
        {
            trace("You are not logged in");
        }
        return $next($request);
    }
}
