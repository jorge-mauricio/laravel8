<?php

declare(strict_types=1);

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
     * @param  ?string $userType
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ?string $userType = null)
    {
        // user_admin token
        if ($userType === config('app.gSystemConfig.configCookiePrefixUserAdmin')) {
            $userAdminLoginToken = session(config('app.gSystemConfig.configCookiePrefix') . '_' . config('app.gSystemConfig.configCookiePrefixUserAdmin') . '_login_token');
            //dd($userAdminLoginToken);
            if ($userAdminLoginToken) {
                // TODO: verify if token is still recorded / valid.
                $request->headers->set('Authorization', 'Bearer ' . $userAdminLoginToken);
                //$next($request)->headers->set('Authorization', 'Bearer ' . $userAdminLoginToken);
            } else {
                // redirect to login
            }
        }

        // user_root token
        if ($userType === config('app.gSystemConfig.configCookiePrefixUserRoot')) {
            $userRootLoginToken = session(config('app.gSystemConfig.configCookiePrefix') . '_' . config('app.gSystemConfig.configCookiePrefixUserRoot') . '_login_token');
            if ($userRootLoginToken) {
                // TODO: verify if token is still recorded / valid.
                $request->headers->set('Authorization', 'Bearer ' . $userRootLoginToken);
            } else {
                // redirect to user login
            }
        }

        // TODO: either create a logic for api records (delete, etc) that checks each one or duplicate the web route inside the respective groups.
        // Also, alternatively, research sanctum to check if there´s a way to set privilege for deleting, etc.

        // Debug.
        //dd($request);
        return $next($request);
    }
}
