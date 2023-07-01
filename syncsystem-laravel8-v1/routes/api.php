<?php

declare(strict_types=1);

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
// Controllers.
use App\Http\Controllers\ApiAuthenticationController;
use App\Http\Controllers\ApiRecordsController;
//use App\Http\Controllers\ApiRecordsDeleteController;
use App\Http\Controllers\ApiCategoriesListingController;
use App\Http\Controllers\ApiCategoriesInsertController;
use App\Http\Controllers\ApiCategoriesDetailsController;
use App\Http\Controllers\ApiCategoriesUpdateController;
use App\Http\Controllers\ApiUsersListingController;
use App\Http\Controllers\ApiUsersInsertController;
use App\Http\Controllers\ApiUsersDetailsController;
use App\Http\Controllers\ApiUsersUpdateController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Debug.
// \SyncSystemNS\FunctionsLog::logLaravel(config('gSystemConfig.configDebug'), 'debug'); // working


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// TODO: route group with middleware


// API - Authentication - POST.
// **************************************************************************************
Route::post(
    '/' . config('app.gSystemConfig.configRouteAPIAuthentication') . '/',
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

// Backend - Records - Delete.
// TODO: middleware function to check user_root or user_backend
// **************************************************************************************
//Route::delete('/records/',[ApiRecordsDeleteController::class, 'deleteRecords'], function($deleteRecordsResults) {
Route::delete(
    '/' . config('app.gSystemConfig.configRouteAPIRecords') . '/',
    [
        ApiRecordsController::class, 'deleteRecords'
    ],
    function ($deleteRecordsResults) {
        //Route::delete('/' . $GLOBALS['configRouteBackendRecords'] . '/',[ApiRecordsDeleteController::class, 'deleteRecords'], function($deleteRecordsResults) {
        //return 'api records (delete)';
        return response()->json($deleteRecordsResults);
    }
)
    ->name(config('app.gSystemConfig.configRouteAPI') . '.' . config('app.gSystemConfig.configRouteAPIRecords'));
// **************************************************************************************

// API - Records - Patch (small changes).
// **************************************************************************************
// Route::patch('/records/', function() {
// Route::patch('/' . $GLOBALS['configRouteBackendRecords'] . '/', function() {
Route::patch(
    '/' . config('app.gSystemConfig.configRouteAPIRecords') . '/',
    [
        ApiRecordsController::class, 'patchRecords'
    ],
    function ($patchRecordsResults) {
        //Route::patch('/' . $GLOBALS['configRouteBackendRecords'] . '/',[ApiRecordsPatchController::class, 'patchRecords'], function($patchRecordsResults) {
        //Route::patch('/' . $GLOBALS['configRouteBackendRecords'] . '/',[ApiRecordsController::class, 'patchRecords'], function($patchRecordsResults) {
        // Debug.
        //return 'api records (patch)';

        return response()->json($patchRecordsResults);
    }
)
    ->name(config('app.gSystemConfig.configRouteAPI') . '.' . config('app.gSystemConfig.configRouteAPIRecords'));
// **************************************************************************************

// API - Records - Edit (multiple fields).
// **************************************************************************************
// Route::patch('/' . $GLOBALS['configRouteBackendRecords'] . '/', function() {
Route::put(
    '/' . config('app.gSystemConfig.configRouteAPIRecords') . '/',
    [
        ApiRecordsController::class, 'editRecords'
    ],
    function ($editRecordsResults) {
        //Route::patch('/' . $GLOBALS['configRouteBackendRecords'] . '/',[ApiRecordsPatchController::class, 'patchRecords'], function($patchRecordsResults) {
        //Route::patch('/' . $GLOBALS['configRouteBackendRecords'] . '/',[ApiRecordsController::class, 'patchRecords'], function($patchRecordsResults) {
        // Debug.
        //return 'api records (patch)';

        return response()->json($editRecordsResults);
    }
)
    ->name(config('app.gSystemConfig.configRouteAPI') . '.' . config('app.gSystemConfig.configRouteAPIRecords'));
// **************************************************************************************

// API - Categories - listing - GET.
// **************************************************************************************
// Debug.
// http://127.0.0.1:8000/api/categories/123
// http://127.0.0.1:8000/api/categories/0
// http://127.0.0.1:8000/api/categories/781
/*Route::get('/categories/{idTbCategories?}', function(?float $idTbCategories = null) {
    return 'categories (get) - ' . $idTbCategories;
});*/
//})->where('idTbCategories', '[+-]?([0-9]*[.])?[0-9]+');
//Route::get('/categories/{idTbCategories?}',[ApiCategoriesListingController::class, 'getCategoriesListing'])->name('api.categories.listing');
/*App::bind('ApiCategoriesListingController', function($app, $paramFromRoute){
    $controller = new ApiCategoriesListingController($paramFromRoute);
    return $controller;
});*/
//Route::get('/categories/{idTbCategories?}','ApiCategoriesListingController')->name('api.categories.listing');

//Route::get('/' . $GLOBALS['configRouteAPICategories'] . '/{idTbCategories?}',[ApiCategoriesListingController::class, 'getCategoriesListing'], function ($getCategoriesListingResults) {
Route::get(
    '/' . config('app.gSystemConfig.configRouteAPICategories') . '/{idTbCategories?}',
    [
        ApiCategoriesListingController::class, 'getCategoriesListing'
    ],
    function ($getCategoriesListingResults) {
        return response()->json($getCategoriesListingResults);
    }
)
    ->name(config('app.gSystemConfig.configRouteAPI') . '.' . config('app.gSystemConfig.configRouteAPICategories'));
// TODO: evaluate converting the route name to dynamic.

// REGEX
// only floating numbers: [+-]?([0-9]*[.])?[0-9]+
// only alphabet: [a-zA-Z]
// **************************************************************************************

// API - Categories - POST (insert record).
// **************************************************************************************
// dev: http://localhost:8001/api/categories/
//Route::post('/' . $GLOBALS['configRouteAPICategories'] . '/',[ApiCategoriesInsertController::class, 'insertCategories'], function($insertCategoriesResults) {
/**/
Route::post(
    '/' . config('app.gSystemConfig.configRouteAPICategories') . '/',
    [
        ApiCategoriesInsertController::class, 'insertCategories'
    ],
    function ($insertCategoriesResults) {
        // Debug.
        //return 'api categories (post) - ' . $idTbCategories;
        //return 'api categories (post)';

        return response()->json($insertCategoriesResults);
    }
)
    ->name(
        config('app.gSystemConfig.configRouteAPI') . '.' .
        config('app.gSystemConfig.configRouteAPICategories') . '.' .
        'insert'
    );

//Route::post('/categories/',[ApiCategoriesInsertController::class, 'insertCategories'])->name('api.categories.insert');
// **************************************************************************************

// API - Categories - details - GET.
// TODO: create another endpoint with /edit
// **************************************************************************************
Route::get(
    '/' . config('app.gSystemConfig.configRouteAPICategories') . '/' . config('app.gSystemConfig.configRouteAPIDetails') . '/{idTbCategories?}',
    [
        ApiCategoriesDetailsController::class, 'getCategoriesDetails'
    ],
    function ($detailsCategoriesResults) {
        return response()->json($detailsCategoriesResults);
    }
)
    ->name(
        config('app.gSystemConfig.configRouteAPI') . '.' .
        config('app.gSystemConfig.configRouteAPICategories') . '.' .
        config('app.gSystemConfig.configRouteAPIDetails')
    );
// **************************************************************************************

// API - Categories - PUT (update record).
// **************************************************************************************
// dev: http://localhost:8001/api/categories/
// TODO: double check in all versions if the id (idTbCategories) is necessary.
//Route::post('/' . $GLOBALS['configRouteAPICategories'] . '/'. $GLOBALS['configRouteAPIActionEdit'] . '/' ,[ApiCategoriesInsertController::class, 'insertCategories'], function($insertCategoriesResults) {
/**/
Route::put(
    '/' . config('app.gSystemConfig.configRouteAPICategories') . '/' . config('app.gSystemConfig.configRouteAPIActionEdit') . '/{idTbCategories?}',
    [
        ApiCategoriesUpdateController::class, 'updateCategories'
    ],
    function ($updateCategoriesResults) {
        // Debug.
        //return 'api categories (post) - ' . $idTbCategories;
        //return 'api categories (post)';

        return response()->json($updateCategoriesResults);
    }
)
    ->name(
        config('app.gSystemConfig.configRouteAPI') . '.' .
        config('app.gSystemConfig.configRouteAPICategories') . '.' .
        config('app.gSystemConfig.configRouteAPIActionEdit')
    );

//Route::post('/categories/',[ApiCategoriesInsertController::class, 'insertCategories'])->name('api.categories.insert');
// **************************************************************************************

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
