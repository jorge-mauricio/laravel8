<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
// Controllers.
use App\Http\Controllers\AdminLoginUsersController;

// Admin - Users - Login.
// **************************************************************************************
Route::get(
    '/' . config('app.gSystemConfig.configRouteBackend') . '/' . config('app.gSystemConfig.configRouteBackendLoginUsers') . '/',
    [
        AdminLoginUsersController::class, 'adminLoginUsers'
    ]
)
    ->name(config('app.gSystemConfig.configRouteBackend')  . '.' . config('app.gSystemConfig.configRouteBackendLoginUsers'));
    // ->name('admin');
// **************************************************************************************

// Admin - Login - Users - POST (check username and password).
// **************************************************************************************
Route::post(
    '/' . config('app.gSystemConfig.configRouteBackend') . '/' . config('app.gSystemConfig.configRouteBackendLoginUsers') . '/',
    [
        AdminLoginUsersController::class, 'adminLoginUsersCheck'
    ]
)
    ->name(config('app.gSystemConfig.configRouteBackend') . '.' . config('app.gSystemConfig.configRouteBackendLoginUsers'));
// **************************************************************************************

// Protected routes (user root).
Route::group(
    [
        'middleware' => [
            'setHeaders.token.web:' . config('app.gSystemConfig.configCookiePrefixUserRoot'),
            'auth:sanctum'
        ]
    ],
    function () {
        // TODO: another middleware for root auth
        // Admin - Users - Logoff - POST.
        // **************************************************************************************
        Route::get(
            '/' . config('app.gSystemConfig.configRouteBackend') . '/' . config('app.gSystemConfig.configRouteBackendLogOffUsersRoot') . '/',
            [
                AdminLoginUsersController::class, 'adminUsersLogoff'
            ]
        )
            ->name(config('app.gSystemConfig.configRouteBackend') . '.' . config('app.gSystemConfig.configRouteBackendLogOffUsersRoot'));
        // **************************************************************************************
    }
);
