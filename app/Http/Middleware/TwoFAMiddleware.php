<?php

/**
 * Class TwoFAMiddleware
 * 
 * Defaults to either Email or Google 2FA depending of use_google2fa field
 */

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class TwoFAMiddleware
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
        $user = Auth::user();

        if ($user && $user->use_google2fa === 1 && !Session::has('user_2fa') && !Session('user_2fa.auth_passed')) {
            return app(\PragmaRX\Google2FALaravel\Middleware::class)->handle($request, $next);
        }

        return $next($request);
        //return app(\App\Http\Middleware\Email2FA::class)->handle($request, $next);
    }
}
