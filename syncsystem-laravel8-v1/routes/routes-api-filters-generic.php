<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
// Controllers.
use App\Http\Controllers\ApiFiltersGenericListingController;
use App\Http\Controllers\ApiFiltersGenericInsertController;
use App\Http\Controllers\ApiFiltersGenericDetailsController;

// API - Filters Generic - listing - GET.
// **************************************************************************************
// dev: http://localhost:8001/system/filters-generic/?tableName=categories&filterIndex=101
Route::get(
    '/' . config('app.gSystemConfig.configRouteBackendFiltersGeneric'),
    [
        ApiFiltersGenericListingController::class, 'getFiltersGenericListing'
    ],
    function ($getFiltersGenericListingResults) {
        return response()->json($getFiltersGenericListingResults);
    }
)
    ->name(
        config('app.gSystemConfig.configRouteAPI') . '.' .
        config('app.gSystemConfig.configRouteBackendFiltersGeneric')
    );
// **************************************************************************************

// API - Filters Generic - POST (insert record).
// **************************************************************************************
// dev: http://localhost:8001/api/filters-generic/
Route::post(
    '/' . config('app.gSystemConfig.configRouteBackendFiltersGeneric') . '/',
    [
        ApiFiltersGenericInsertController::class, 'insertFiltersGeneric'
    ],
    function ($insertFiltersGenericResults) {
        return response()->json($insertFiltersGenericResults);
    }
)
    ->name(
        config('app.gSystemConfig.configRouteAPI') . '.' .
        config('app.gSystemConfig.configRouteBackendFiltersGeneric') . '.' .
        'insert'
    );
// **************************************************************************************

// API - Filters Generic - details - GET.
// **************************************************************************************
Route::get(
    '/' . config('app.gSystemConfig.configRouteAPIFiltersGeneric') . '/' . config('app.gSystemConfig.configRouteAPIDetails') . '/{idTbFiltersGeneric?}',
    [
        ApiFiltersGenericDetailsController::class, 'getFiltersGenericDetails'
    ],
    function ($detailsFiltersGenericResults) {
        return response()->json($detailsFiltersGenericResults);
    }
)
    ->name(
        config('app.gSystemConfig.configRouteAPI') . '.' .
        config('app.gSystemConfig.configRouteAPIFiltersGeneric') . '.' .
        config('app.gSystemConfig.configRouteAPIDetails')
    );
// **************************************************************************************
