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
        // Debug: http://localhost:8000/system/categories/781
        Route::get(
            '/' . config('app.gSystemConfig.configRouteBackend') . '/' . config('app.gSystemConfig.configRouteBackendFiltersGeneric') . '/',
            [
                AdminFiltersGenericController::class, 'adminFiltersGenericListing'
            ]
        )
            ->name(config('app.gSystemConfig.configRouteBackend') . '.' . config('app.gSystemConfig.configRouteBackendFiltersGeneric'));
        // **************************************************************************************
    }
);
