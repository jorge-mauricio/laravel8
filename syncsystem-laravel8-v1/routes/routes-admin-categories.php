<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
// Controllers.
use App\Http\Controllers\AdminCategoriesController;

// Protected routes (user root).
Route::group(
    [
        'middleware' => [
            'setHeaders.token.web:' . config('app.gSystemConfig.configCookiePrefixUserAdmin'),
            'auth:sanctum'
        ]
    ],
    function () {
        // TODO: make auth sanctum conditioned to $GLOBALS['configRegistersAuthenticationType'] === 11
        //Route::group(['middleware' => ['auth:sanctum', 'setHeaders.token.web']], function () {

        // Testing architecture.
        // Route::get('/system/dashboard/',[AdminDashboardController::class, 'adminDashboard'], function($request) {
        //     return view('admin.dashboard', [
        //         'clients' => $request->user()->clients
        //     ]);
        // })->middleware(['auth'])->name('admin.dashboard');
        // TODO: evaluate changing the architecture - return the data from the classes and bind with the views in the route´s functions.
        // **************************************************************************************

        // Admin - Categories - listing - GET.
        // **************************************************************************************
        // Debug: http://127.0.0.1:8000/admin/categories/123
        // Debug: http://127.0.0.1:8000/admin/categories/781
        // Debug: http://localhost:8000/system/categories/781
        Route::get(
            '/' . config('app.gSystemConfig.configRouteBackend') . '/' . config('app.gSystemConfig.configRouteBackendCategories') . '/{idTbCategories?}',
            [
                AdminCategoriesController::class, 'adminCategoriesListing'
            ]
        )
            ->name(config('app.gSystemConfig.configRouteBackend') . '.' . config('app.gSystemConfig.configRouteBackendCategories'));
            //->name('admin.categories.listing');
            // TODO: include regex for the slug.
        //Route::get('/' . $GLOBALS['configRouteBackend'] . '/' . $GLOBALS['configRouteBackendCategories'] . '/{idTbCategories?}',[AdminCategoriesController::class, 'adminCategoriesListing'])->name('admin.categories.listing');
        //Route::get('/admin/categories/{idParent?}',[AdminCategoriesController::class, 'getCategoriesListing'])->name('admin.categories.listing');
        // **************************************************************************************

        // Admin - Categories - POST (insert record).
        // **************************************************************************************
        //Route::post('/' . $GLOBALS['configRouteBackend'] . '/' . $GLOBALS['configRouteBackendCategories'] . '/',[AdminCategoriesController::class, 'adminCategoriesInsert'])->name('admin.categories.insert');
        Route::post(
            '/' . config('app.gSystemConfig.configRouteBackend') . '/' . config('app.gSystemConfig.configRouteBackendCategories') . '/',
            [
                AdminCategoriesController::class, 'adminCategoriesInsert'
            ]
        )
            ->name(
                config('app.gSystemConfig.configRouteBackend') . '.' .
                config('app.gSystemConfig.configRouteBackendCategories') . '.' .
                'insert'
            );
            // ->name('admin.categories.insert');
            // TODO: investigate further the error when using the same route name (even with different request types)
                // ref: https://laracasts.com/discuss/channels/laravel/unable-to-prepare-route-widgets-for-serialization-another-route-has-already-been-assigned-name-widgetsindex
                    // It was indeed a naming overlap as Laravel automatically namspaces routes when using the resource and apiResource methods with the following pattern {resourceName}.{controllerAction}. In that specific case it means widgets.index|show|store|update|destroy were defined twice.
                        // Maybe, has something to do with the controller / method pattern
        // **************************************************************************************

        // Admin - Categories - edit - GET.
        // **************************************************************************************
        // Debug: http://localhost:8000/system/categories/edit/1999/?masterPageSelect=layout-admin-main
        Route::get(
            '/' . config('app.gSystemConfig.configRouteBackend') . '/' . config('app.gSystemConfig.configRouteBackendCategories') . '/' . config('app.gSystemConfig.configRouteBackendActionEdit') . '/{idTbCategories?}',
            [
                AdminCategoriesController::class, 'adminCategoriesEdit'
            ]
        )
            ->name(
                config('app.gSystemConfig.configRouteBackend') . '.' .
                config('app.gSystemConfig.configRouteBackendCategories') . '.' .
                config('app.gSystemConfig.configRouteBackendActionEdit')
            );
        //Route::get('/' . $GLOBALS['configRouteBackend'] . '/' . $GLOBALS['configRouteBackendCategories'] . '/{idTbCategories?}',[AdminCategoriesController::class, 'adminCategoriesListing'])->name('admin.categories.listing');
        //Route::get('/admin/categories/{idParent?}',[AdminCategoriesController::class, 'getCategoriesListing'])->name('admin.categories.listing');
        // **************************************************************************************

        // Admin - Categories - edit - PUT.
        // TODO: reflect this pattern in node version.
        // **************************************************************************************
        // Debug: http://localhost:8000/system/categories/edit/1999/?masterPageSelect=layout-admin-main
        Route::put(
            '/' . config('app.gSystemConfig.configRouteBackend') . '/' . config('app.gSystemConfig.configRouteBackendCategories') . '/' . config('app.gSystemConfig.configRouteBackendActionEdit') . '/{idTbCategories?}',
            [
                AdminCategoriesController::class, 'adminCategoriesUpdate'
            ]
        )
            ->name(
                config('app.gSystemConfig.configRouteBackend') . '.' .
                config('app.gSystemConfig.configRouteBackendCategories') . '.' .
                config('app.gSystemConfig.configRouteBackendActionEdit')
            );
            // ->name('admin.categories.update');
        //Route::get('/' . $GLOBALS['configRouteBackend'] . '/' . $GLOBALS['configRouteBackendCategories'] . '/{idTbCategories?}',[AdminCategoriesController::class, 'adminCategoriesListing'])->name('admin.categories.listing');
        //Route::get('/admin/categories/{idParent?}',[AdminCategoriesController::class, 'getCategoriesListing'])->name('admin.categories.listing');
        // **************************************************************************************
    }
);
