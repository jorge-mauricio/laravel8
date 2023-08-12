<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
// Controllers.
use App\Http\Controllers\AdminUsersController;

Route::group(
    [
        'middleware' => [
            'setHeaders.token.web:' . config('app.gSystemConfig.configCookiePrefixUserRoot'),
            'auth:sanctum'
        ]
    ],
    function () {
        // Admin - Users - listing - GET.
        // **************************************************************************************
        Route::get(
            '/' . config('app.gSystemConfig.configRouteBackend') . '/' . config('app.gSystemConfig.configRouteBackendUsers') . '/{idParent?}',
            [
                AdminUsersController::class, 'adminUsersListing'
            ]
        )
            ->name(config('app.gSystemConfig.configRouteBackend') . '.' . config('app.gSystemConfig.configRouteBackendUsers'));
        // **************************************************************************************

        // Admin - Users - POST (insert record).
        // **************************************************************************************
        Route::post(
            '/' . config('app.gSystemConfig.configRouteBackend') . '/' . config('app.gSystemConfig.configRouteBackendUsers') . '/',
            [
                AdminUsersController::class, 'adminUsersInsert'
            ]
        )
            ->name(
                config('app.gSystemConfig.configRouteBackend') . '.' .
                config('app.gSystemConfig.configRouteBackendUsers') . '.' .
                'insert'
            );
        // **************************************************************************************

        // Admin - Users - edit - GET.
        // **************************************************************************************
        // Debug: http://localhost:8000/admin/users/edit/2026/?masterPageSelect=layout-admin-main
        Route::get(
            '/' . config('app.gSystemConfig.configRouteBackend') . '/' . config('app.gSystemConfig.configRouteBackendUsers') . '/' . config('app.gSystemConfig.configRouteBackendActionEdit') . '/{idTbUsers?}',
            [
                AdminUsersController::class, 'adminUsersEdit'
            ]
        )
            ->name(
                config('app.gSystemConfig.configRouteBackend') . '.' .
                config('app.gSystemConfig.configRouteBackendUsers') . '.' .
                config('app.gSystemConfig.configRouteBackendActionEdit')
            );
        // **************************************************************************************

        // Admin - Users - edit - PUT.
        // TODO: reflect this pattern in node version.
        // **************************************************************************************
        // Debug: http://localhost:8000/admin/users/edit/1999/?masterPageSelect=layout-admin-main
        Route::put(
            '/' . config('app.gSystemConfig.configRouteBackend') . '/' . config('app.gSystemConfig.configRouteBackendUsers') . '/' . config('app.gSystemConfig.configRouteBackendActionEdit') . '/{idTbUsers?}',
            [
                AdminUsersController::class, 'adminUsersUpdate'
            ]
        )
            ->name(
                config('app.gSystemConfig.configRouteBackend') . '.' .
                config('app.gSystemConfig.configRouteBackendUsers') . '.' .
                config('app.gSystemConfig.configRouteBackendActionEdit')
            );
            // ->name('admin.categories.update');
        // **************************************************************************************
    }
);
