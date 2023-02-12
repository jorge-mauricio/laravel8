<?php

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
Route::post('/authentication/',[ApiAuthenticationController::class, 'authenticationCheck'], function($authenticationCheckResults) {
    // Debug.
    //return 'api categories (post) - ' . $idTbCategories;
    //return 'api categories (post)';

    return response()->json($authenticationCheckResults);
})->name('api.authentication.authenticationCheck');
// **************************************************************************************

// Backend - Records - Delete.
// TODO: middleware function to check user_root or user_backend
// **************************************************************************************
//Route::delete('/records/',[ApiRecordsDeleteController::class, 'deleteRecords'], function($deleteRecordsResults) {
Route::delete('/records/',[ApiRecordsController::class, 'deleteRecords'], function($deleteRecordsResults) {
//Route::delete('/' . $GLOBALS['configRouteBackendRecords'] . '/',[ApiRecordsDeleteController::class, 'deleteRecords'], function($deleteRecordsResults) {
    //return 'api records (delete)';
    return response()->json($deleteRecordsResults);
})->name('api.records.delete');
// **************************************************************************************

// API - Records - Patch (small changes).
// **************************************************************************************
// Route::patch('/records/', function() {
// Route::patch('/' . $GLOBALS['configRouteBackendRecords'] . '/', function() {
Route::patch('/records/',[ApiRecordsController::class, 'patchRecords'], function($patchRecordsResults) {
//Route::patch('/' . $GLOBALS['configRouteBackendRecords'] . '/',[ApiRecordsPatchController::class, 'patchRecords'], function($patchRecordsResults) {
//Route::patch('/' . $GLOBALS['configRouteBackendRecords'] . '/',[ApiRecordsController::class, 'patchRecords'], function($patchRecordsResults) {
    // Debug.
    //return 'api records (patch)';

    return response()->json($patchRecordsResults);
})->name('api.records.patch');
// **************************************************************************************

// API - Records - Edit (multiple fields).
// **************************************************************************************
// Route::patch('/' . $GLOBALS['configRouteBackendRecords'] . '/', function() {
Route::put('/records/',[ApiRecordsController::class, 'editRecords'], function($editRecordsResults) {
//Route::patch('/' . $GLOBALS['configRouteBackendRecords'] . '/',[ApiRecordsPatchController::class, 'patchRecords'], function($patchRecordsResults) {
//Route::patch('/' . $GLOBALS['configRouteBackendRecords'] . '/',[ApiRecordsController::class, 'patchRecords'], function($patchRecordsResults) {
    // Debug.
    //return 'api records (patch)';

    return response()->json($editRecordsResults);
})->name('api.records.edit');
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
Route::get('/categories/{idTbCategories?}',[ApiCategoriesListingController::class, 'getCategoriesListing'], function ($getCategoriesListingResults) {
    return response()->json($getCategoriesListingResults);
})->name('api.categories.listing');


// REGEX
// only floating numbers: [+-]?([0-9]*[.])?[0-9]+
// only alphabet: [a-zA-Z]
// **************************************************************************************

// API - Categories - details - GET.
// TODO: create another endpoint with /edit
// **************************************************************************************
Route::get('/categories/details/{idTbCategories?}',[ApiCategoriesDetailsController::class, 'getCategoriesDetails'], function($detailsCategoriesResults) {
    return response()->json($detailsCategoriesResults);
})->name('api.categories.details');
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

// API - Categories - PUT (update record).
// **************************************************************************************
// dev: http://localhost:8001/api/admin/categories/
//Route::post('/' . $GLOBALS['configRouteAPICategories'] . '/'. $GLOBALS['configRouteAPIActionEdit'] . '/' ,[ApiCategoriesInsertController::class, 'insertCategories'], function($insertCategoriesResults) {
/**/
Route::put('/categories/edit/{idTbCategories?}',[ApiCategoriesUpdateController::class, 'updateCategories'], function($updateCategoriesResults) {
    // Debug.
    //return 'api categories (post) - ' . $idTbCategories;
    //return 'api categories (post)';

    return response()->json($updateCategoriesResults);
})->name('api.categories.update');

//Route::post('/categories/',[ApiCategoriesInsertController::class, 'insertCategories'])->name('api.categories.insert');
// **************************************************************************************



