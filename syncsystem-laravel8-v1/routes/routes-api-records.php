<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
// Controllers.
use App\Http\Controllers\ApiRecordsController;

// use App\Http\Controllers\ApiRecordsDeleteController;

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
