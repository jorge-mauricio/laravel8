<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
// Controllers.
use App\Http\Controllers\ApiCategoriesListingController;
use App\Http\Controllers\ApiCategoriesInsertController;
use App\Http\Controllers\ApiCategoriesDetailsController;
use App\Http\Controllers\ApiCategoriesUpdateController;

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
    '/' . config('app.gSystemConfig.configRouteAPICategories') . '/' . config('app.gSystemConfig.configRouteAPIActionEdit') . '/',
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
