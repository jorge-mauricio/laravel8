<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
// Controllers.
use App\Http\Controllers\AdminRecordsController;

// Protected routes (any logged user).
Route::group(
    [
        'middleware' => [
            'setHeaders.token.web',
            'auth:sanctum'
        ]
    ],
    function () {
        // Admin - Records - DELETE.
        // TODO: change to system/records
        // **************************************************************************************
        //Route::post('/' . $GLOBALS['configRouteBackend'] . '/' . $GLOBALS['configRouteBackendCategories'] . '/',[AdminCategoriesController::class, 'adminCategoriesInsert'])->name('admin.categories.insert');
        //Route::delete('/system/categories/',[AdminCategoriesController::class, 'adminCategoriesDelete'])->name('admin.categories.delete');
        Route::delete(
            '/' . config('app.gSystemConfig.configRouteBackend') . '/' . config('app.gSystemConfig.configRouteBackendRecords') . '/',
            [
                AdminRecordsController::class, 'adminRecordsDelete'
            ]
        )
            ->name(config('app.gSystemConfig.configRouteBackend') . '.' . config('app.gSystemConfig.configRouteBackendRecords'));
            // ->name('admin.records.delete');
        // **************************************************************************************
    }
);
