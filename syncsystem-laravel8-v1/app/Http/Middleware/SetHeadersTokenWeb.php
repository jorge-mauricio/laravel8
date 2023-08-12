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
        if ($userType) {
            // User admin token.
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

            // User root token.
            if ($userType === config('app.gSystemConfig.configCookiePrefixUserRoot')) {
                $userRootLoginToken = session(config('app.gSystemConfig.configCookiePrefix') . '_' . config('app.gSystemConfig.configCookiePrefixUserRoot') . '_login_token');
                if ($userRootLoginToken) {
                    // TODO: verify if token is still recorded / valid.
                    $request->headers->set('Authorization', 'Bearer ' . $userRootLoginToken);
                } else {
                    // redirect to user login
                }
            }
        } else {
            // Any token (for delete / patch).
            // TODO: Alternatively, research sanctum to check if there´s a way to set privilege for deleting, etc.
            $userAdminLoginAnyToken = session(config('app.gSystemConfig.configCookiePrefix') . '_' . config('app.gSystemConfig.configCookiePrefixUserAdmin') . '_login_token');
            if (!$userAdminLoginAnyToken) {
                $userAdminLoginAnyToken = session(config('app.gSystemConfig.configCookiePrefix') . '_' . config('app.gSystemConfig.configCookiePrefixUserRoot') . '_login_token');
                // TODO: move sessions into syncsystem function (so that we maintain the same structure throughout all languages).
            }
            if ($userAdminLoginAnyToken) {
                $request->headers->set('Authorization', 'Bearer ' . $userAdminLoginAnyToken);
            } else {
                // redirect to login
            }

            // Debug.
            // dump(session(config('app.gSystemConfig.configCookiePrefix') . '_' . config('app.gSystemConfig.configCookiePrefixUserAdmin') . '_login_token'));
            // dump(session(config('app.gSystemConfig.configCookiePrefix') . '_' . config('app.gSystemConfig.configCookiePrefixUserRoot') . '_login_token'));
            // dd($userAdminLoginAnyToken);
        }

        // Debug.
        // dd($request);
        return $next($request);
    }
}
