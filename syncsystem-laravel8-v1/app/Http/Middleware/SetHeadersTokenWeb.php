<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SetHeadersTokenWeb
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse) $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // user_admin token
        $userAdminLoginToken = session($GLOBALS['configCookiePrefix'] . '_' . $GLOBALS['configCookiePrefixUserAdmin'] . '_login_token');
        if ($userAdminLoginToken) {
            // TODO: verify if token is still recorded / valid.
            $request->headers->set('Authorization', 'Bearer ' . $userAdminLoginToken);
            //$next($request)->headers->set('Authorization', 'Bearer ' . $userAdminLoginToken);
        }

        // Debug.
        //dd($request);
        return $next($request);
    }
}
