<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
// Controllers.
use App\Http\Controllers\ApiUsersListingController;
use App\Http\Controllers\ApiUsersInsertController;
use App\Http\Controllers\ApiUsersDetailsController;
use App\Http\Controllers\ApiUsersUpdateController;

// API - Users - listing - GET.
// **************************************************************************************
Route::get(
    '/' . config('app.gSystemConfig.configRouteAPIUsers') . '/{idParent?}',
    [
        ApiUsersListingController::class, 'getUsersListing'
    ],
    function ($usersListingResults) {
        return response()->json($usersListingResults);
    }
)
    ->name(
        config('app.gSystemConfig.configRouteAPI') . '.' .
        config('app.gSystemConfig.configRouteAPIUsers')
    );
// **************************************************************************************

// API - Users - POST (insert record).
// **************************************************************************************
// dev: http://localhost:8001/api/users/
Route::post(
    '/' . config('app.gSystemConfig.configRouteAPIUsers') . '/',
    [
        ApiUsersInsertController::class, 'insertUsers'
    ],
    function ($insertUsersResults) {
        return response()->json($insertUsersResults);
    }
)
    ->name(
        config('app.gSystemConfig.configRouteAPI') . '.' .
        config('app.gSystemConfig.configRouteAPIUsers') . '.' .
        'insert'
    );
// **************************************************************************************

// API - Users - details - GET.
// TODO: create another endpoint with /edit
// **************************************************************************************
Route::get(
    '/' . config('app.gSystemConfig.configRouteAPIUsers') . '/' . config('app.gSystemConfig.configRouteAPIDetails') . '/{idTbUsers?}',
    [
        ApiUsersDetailsController::class, 'getUsersDetails'
    ],
    function ($usersDetailsResults) {
        return response()->json($usersDetailsResults);
    }
)
    ->name(
        config('app.gSystemConfig.configRouteAPI') . '.' .
        config('app.gSystemConfig.configRouteAPIUsers') . '.' .
        config('app.gSystemConfig.configRouteAPIDetails')
    );
// **************************************************************************************

// API - Users - PUT (update record).
// **************************************************************************************
// dev: http://localhost:8001/api/users/edit/2026
Route::put(
    '/' . config('app.gSystemConfig.configRouteAPIUsers') . '/' . config('app.gSystemConfig.configRouteAPIActionEdit') . '/{idTbUsers?}',
    [
        ApiUsersUpdateController::class, 'updateUsers'
    ],
    function ($updateUsersResults) {
        return response()->json($updateUsersResults);
    }
)
    ->name(
        config('app.gSystemConfig.configRouteAPI') . '.' .
        config('app.gSystemConfig.configRouteAPIUsers') . '.' .
        config('app.gSystemConfig.configRouteAPIActionEdit')
    );
// **************************************************************************************
