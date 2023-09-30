<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
// Controllers.
use App\Http\Controllers\ApiAuthenticationController;

// API - Authentication - POST.
// **************************************************************************************
Route::post(
    '/' . config('app.gSystemConfig.configRouteAPIAuthentication') . '/',
    // '/' . config('app.gSystemConfig.configRouteAPIAuthentication') . '{optionalSlash?}',
    // '/' . config('app.gSystemConfig.configRouteAPIAuthentication') . '/{param?}',
    [
        ApiAuthenticationController::class, 'authenticationCheck'
    ],
    function ($authenticationCheckResults) {
        // Debug.
        //return 'api categories (post) - ' . $idTbCategories;
        //return 'api categories (post)';

        return response()->json($authenticationCheckResults);
    }
)
    // ->where(config('app.gSystemConfig.configRouteAPIAuthentication'), '.*') // Not working with .htaccess redirect rule.
    // ->where(config('app.gSystemConfig.configRouteAPIAuthentication'), '.*\/') // Not working with .htaccess redirect rule.
    // ->where('optionalSlash', '/?') // Not working with .htaccess redirect rule.
    // ->where('optionalSlash', '\/?') // Not working with .htaccess redirect rule.
    // ->where(
    //     'param',
    //     config('app.gSystemConfig.configRouteAPI') . '/' .
    //     config('app.gSystemConfig.configRouteAPIAuthentication') .
    //     '/?'
    // ) // Not working with .htaccess redirect rule.
    ->name(config('app.gSystemConfig.configRouteAPI') . '.' . config('app.gSystemConfig.configRouteAPIAuthentication'));
    // ->name('api.authentication.authenticationCheck');
// **************************************************************************************

// API - Authentication - DELETE.
// **************************************************************************************
Route::delete(
    '/' . config('app.gSystemConfig.configRouteAPIAuthentication') . '/',
    [
        ApiAuthenticationController::class, 'authenticationDelete'
    ],
    function ($authenticationDeleteResults) {
        // Debug.
        //return 'api categories (post) - ' . $idTbCategories;
        //return 'api categories (post)';

        return response()->json($authenticationDeleteResults);
    }
)
    ->name(
        config('app.gSystemConfig.configRouteAPI') . '.' .
        config('app.gSystemConfig.configRouteAPIAuthentication') . '.' .
        'delete'
    );
    // ->name('api.authentication.authenticationDelete');
// **************************************************************************************
