<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
// Controllers.
use App\Http\Controllers\FrontendHomeController;
use App\Http\Controllers\FrontendCategoriesListingController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


// Resources - GET.
// **************************************************************************************
/*Route::get('/files-layout-test/{filename?}', function($filename){

    //$path = resource_path() . '/' . 'app_files_layout/' . $filename;
    //$path = resource_path() . DIRECTORY_SEPARATOR  . 'files-layout' . DIRECTORY_SEPARATOR . $filename;
    //$path = resource_path() . DIRECTORY_SEPARATOR  . 'app_files_layout' . DIRECTORY_SEPARATOR . $filename;
    $path = asset('files-layout/' . $filename);

    // Debug.
    //dd($path);
    //echo 'path=' . $path;

    if(!File::exists($path)) {
        return response()->json(['message' => 'Image not found.'], 404);
    }

    $file = File::get($path);
    $type = File::mimeType($path);

    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);

    return $response;



});*/
// **************************************************************************************


// Home.
// **************************************************************************************
Route::get(
    '/' . config('app.gSystemConfig.configRouteFrontend'),
    [
        FrontendHomeController::class, 'render'
    ]
)
    ->name('frontend.home');
    //->name(config('app.gSystemConfig.configRouteFrontend'));
// **************************************************************************************


// Admin - Layout - GET.
// Debug: http://127.0.0.1:8000/admin/layout
Route::get('/admin/layout', function () {
    return view('layout-backend-main');
});


// Frontend - Categories - listing - GET.
// **************************************************************************************
// Debug: http://127.0.0.1:8000/admin/categories/123
// Debug: http://127.0.0.1:8000/categories/102
// Route::get('/categories/{idTbCategories?}',[FrontendCategoriesListingController::class, 'build'])->name('categories.build');
Route::get('/categories/{idTbCategories?}', [FrontendCategoriesListingController::class, '__construct'])->name('categories.listing'); // Inside Laravel, you can redirect to route like: {{ route('categories.listing') }}
// **************************************************************************************

/*
use App\Http\Controllers\OrderController;

Route::controller(OrderController::class)->group(function () {
    Route::get('/orders/{id}', 'show');
    Route::post('/orders', 'store');
});
*/

//});
// Route::get('/system/dashboard/',[AdminDashboardController::class, 'adminDashboard'])
//     ->name('admin.dashboard')
//     //->middleware('auth');
//     ->middleware('auth:sanctum');

// Admin (general) - import from external routes file.
// ----------------------
require_once 'routes-admin-records.php';
// ----------------------

// Login - import from external routes file.
// ----------------------
// Admin.
require_once 'routes-admin.php';
require_once 'routes-admin-login-users.php';
// ----------------------

// Categories - import from external routes file.
// ----------------------
// Admin.
require_once 'routes-admin-categories.php';
// ----------------------

// Users - import from external routes file.
// ----------------------
// Admin.
require_once 'routes-admin-users.php';
// ----------------------

