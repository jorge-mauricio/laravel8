<?php

declare(strict_types=1);

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Controllers.

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

// Backend (general) - import from external routes file.
// ----------------------
// API.
require_once 'routes-api-records.php';
// ----------------------

// Login - import from external routes file.
// ----------------------
// API.
require_once 'routes-api-authentication.php';
// ----------------------

// Categories - import from external routes file.
// ----------------------
// API.
require_once 'routes-api-categories.php';
// ----------------------

// Categories - import from external routes file.
// ----------------------
// API.
require_once 'routes-api-filters-generic.php';
// ----------------------

// Users - import from external routes file.
// ----------------------
// API.
require_once 'routes-api-users.php';
// ----------------------
