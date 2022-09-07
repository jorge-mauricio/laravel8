<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Controllers.
use App\Http\Controllers\ApiCategoriesListingController;
use App\Http\Controllers\ApiCategoriesInsertController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// TODO: route group with middleware

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
Route::get('/categories/{idTbCategories?}',[ApiCategoriesListingController::class, 'getCategoriesListing'], function ($getCategoriesListingResults) {
    return response()->json($getCategoriesListingResults);
})->name('api.categories.listing');




// REGEX
// only floating numbers: [+-]?([0-9]*[.])?[0-9]+
// only alphabet: [a-zA-Z]
// **************************************************************************************


// API - Categories - POST (insert record).
// **************************************************************************************
// dev: http://localhost:8001/api/admin/categories/
//Route::post('/' . $GLOBALS['configRouteAPICategories'] . '/',[ApiCategoriesInsertController::class, 'insertCategories'], function($insertCategoriesResults) {
/**/
Route::post('/categories/',[ApiCategoriesInsertController::class, 'insertCategories'], function($insertCategoriesResults) {
    // Debug.
    //return 'api categories (post) - ' . $idTbCategories;
    //return 'api categories (post)';

    return response()->json($insertCategoriesResults);
})->name('api.categories.insert');

//Route::post('/categories/',[ApiCategoriesInsertController::class, 'insertCategories'])->name('api.categories.insert');
// **************************************************************************************
