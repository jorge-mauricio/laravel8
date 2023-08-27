<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
// Controllers.
use App\Http\Controllers\AdminFiltersGenericController;

// Protected routes (user root).
Route::group(
    [
        'middleware' => [
            'setHeaders.token.web:' . config('app.gSystemConfig.configCookiePrefixUserAdmin'),
            'auth:sanctum'
        ]
    ],
    function () {
        // Admin - Filters Generic - listing - GET.
        // **************************************************************************************
        // Debug: http://localhost:8000/system/filters-generic/?tableName=categories&filterIndex=101
        Route::get(
            '/' . config('app.gSystemConfig.configRouteBackend') . '/' . config('app.gSystemConfig.configRouteBackendFiltersGeneric') . '/',
            [
                AdminFiltersGenericController::class, 'adminFiltersGenericListing'
            ]
        )
            ->name(config('app.gSystemConfig.configRouteBackend') . '.' . config('app.gSystemConfig.configRouteBackendFiltersGeneric'));
        // **************************************************************************************

        // Admin - Filters Generic - POST (insert record).
        // **************************************************************************************
        Route::post(
            '/' . config('app.gSystemConfig.configRouteBackend') . '/' . config('app.gSystemConfig.configRouteBackendFiltersGeneric') . '/',
            [
                AdminFiltersGenericController::class, 'adminFiltersGenericInsert'
            ]
        )
            ->name(
                config('app.gSystemConfig.configRouteBackend') . '.' .
                config('app.gSystemConfig.configRouteBackendFiltersGeneric') . '.' .
                'insert'
            );
        // **************************************************************************************

        // Admin - Filters Generic - edit - GET.
        // **************************************************************************************
        // Debug: http://localhost:8000/system/filters-generic/edit/2062/?masterPageSelect=layout-admin-main
        Route::get(
            '/' . config('app.gSystemConfig.configRouteBackend') . '/' . config('app.gSystemConfig.configRouteBackendFiltersGeneric') . '/' . config('app.gSystemConfig.configRouteBackendActionEdit') . '/{idTbFiltersGeneric?}',
            [
                AdminFiltersGenericController::class, 'adminFiltersGenericEdit'
            ]
        )
            ->name(
                config('app.gSystemConfig.configRouteBackend') . '.' .
                config('app.gSystemConfig.configRouteBackendFiltersGeneric') . '.' .
                config('app.gSystemConfig.configRouteBackendActionEdit')
            );
        // **************************************************************************************

        // Admin - Filters Generic - edit - PUT.
        // **************************************************************************************
        // Debug: http://localhost:8000/system/filters-generic/edit/2062/?masterPageSelect=layout-admin-main
        Route::put(
            '/' . config('app.gSystemConfig.configRouteBackend') . '/' . config('app.gSystemConfig.configRouteBackendFiltersGeneric') . '/' . config('app.gSystemConfig.configRouteBackendActionEdit') . '/{idTbFiltersGeneric?}',
            [
                AdminFiltersGenericController::class, 'adminFiltersGenericUpdate'
            ]
        )
            ->name(
                config('app.gSystemConfig.configRouteBackend') . '.' .
                config('app.gSystemConfig.configRouteBackendFiltersGeneric') . '.' .
                config('app.gSystemConfig.configRouteBackendActionEdit')
            );
        // **************************************************************************************
    }
);
