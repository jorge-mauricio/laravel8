<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
// Controllers.
use App\Http\Controllers\ApiFiltersGenericListingController;

// API - Filters Generic - listing - GET.
// **************************************************************************************
Route::get(
    '/' . config('app.gSystemConfig.configRouteBackendFiltersGeneric'),
    [
        ApiFiltersGenericListingController::class, 'getFiltersGenericListing'
    ],
    function ($getFiltersGenericListingResults) {
        return response()->json($getFiltersGenericListingResults);
    }
)
    ->name(config('app.gSystemConfig.configRouteAPI') . '.' . config('app.gSystemConfig.configRouteBackendFiltersGeneric'));
// **************************************************************************************
