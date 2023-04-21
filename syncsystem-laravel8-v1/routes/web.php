<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
// Controllers.
use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminCategoriesController;
use App\Http\Controllers\AdminRecordsController;
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

// Admin - Home - Login.
// **************************************************************************************
// Route::get('/system/',[AdminLoginController::class, 'adminLogin'])->name('admin.login');
Route::get('/' . config('app.gSystemConfig.configRouteBackend') . '/', [
        AdminLoginController::class, 'adminLogin'
    ])
    ->name('admin.login');
// **************************************************************************************

// Admin - Login - POST (check username and password).
// **************************************************************************************
// Route::post('/system/login/',[AdminLoginController::class, 'adminLoginCheck'])->name('admin.login.check');
Route::post('/' . config('app.gSystemConfig.configRouteBackend') . '/' . config('app.gSystemConfig.configRouteBackendLogin') . '/', [
        AdminLoginController::class, 'adminLoginCheck'
    ])
    ->name('admin.login.check');
// **************************************************************************************

// Protected routes.
//Route::group(['middleware' => 'setHeaders.token.web'], function () {
    //Route::group(['middleware' => 'auth:sanctum'], function () {
Route::group(['middleware' => ['setHeaders.token.web', 'auth:sanctum']], function () {
    // TODO: make auth sanctum conditioned to $GLOBALS['configRegistersAuthenticationType'] === 11
//Route::group(['middleware' => ['auth:sanctum', 'setHeaders.token.web']], function () {

    // Admin - Logoff - POST.
    // **************************************************************************************
    // Route::get('/system/logoff/', [AdminLoginController::class, 'adminLogoff'])->name('admin.logoff');
    Route::get('/' . config('app.gSystemConfig.configRouteBackend') . '/' . config('app.gSystemConfig.configRouteBackendLogOff') . '/', [
            AdminLoginController::class, 'adminLogoff'
        ])
        ->name('admin.logoff');
    // **************************************************************************************

    // Admin - Dashboard.
    // **************************************************************************************
    // Route::get('/system/dashboard/', [AdminDashboardController::class, 'adminDashboard'])->name('admin.dashboard');
    Route::get('/' . config('app.gSystemConfig.configRouteBackend') . '/' . config('app.gSystemConfig.configRouteBackendDashboard') . '/', [
            AdminDashboardController::class, 'adminDashboard'
        ])
        ->name('admin.dashboard');
    // Route::get('/system/dashboard/',[AdminDashboardController::class, 'adminDashboard'])->name('admin.dashboard')->middleware('setHeaders.token.web');

    // Testing architecture.
    // Route::get('/system/dashboard/',[AdminDashboardController::class, 'adminDashboard'], function($request) {
    //     return view('admin.dashboard', [
    //         'clients' => $request->user()->clients
    //     ]);
    // })->middleware(['auth'])->name('admin.dashboard');
    // TODO: evaluate changing the architecture - return the data from the classes and bind with the views in the route´s functions.
    // **************************************************************************************

    // Admin - Categories - listing - GET.
    // **************************************************************************************
    // Debug: http://127.0.0.1:8000/admin/categories/123
    // Debug: http://127.0.0.1:8000/admin/categories/781
    // Debug: http://localhost:8000/system/categories/781
    Route::get('/' . config('app.gSystemConfig.configRouteBackend') . '/' . config('app.gSystemConfig.configRouteBackendCategories') . '/{idTbCategories?}', [
            AdminCategoriesController::class, 'adminCategoriesListing'
        ])
        ->name('admin.categories.listing');
    //Route::get('/' . $GLOBALS['configRouteBackend'] . '/' . $GLOBALS['configRouteBackendCategories'] . '/{idTbCategories?}',[AdminCategoriesController::class, 'adminCategoriesListing'])->name('admin.categories.listing');
    //Route::get('/admin/categories/{idParent?}',[AdminCategoriesController::class, 'getCategoriesListing'])->name('admin.categories.listing');
    // **************************************************************************************

    // Admin - Categories - POST (insert record).
    // **************************************************************************************
    //Route::post('/' . $GLOBALS['configRouteBackend'] . '/' . $GLOBALS['configRouteBackendCategories'] . '/',[AdminCategoriesController::class, 'adminCategoriesInsert'])->name('admin.categories.insert');
    Route::post('/' . config('app.gSystemConfig.configRouteBackend') . '/' . config('app.gSystemConfig.configRouteBackendCategories') . '/', [
            AdminCategoriesController::class, 'adminCategoriesInsert'
        ])
        ->name('admin.categories.insert');
    // **************************************************************************************

    // Admin - Categories - edit - GET.
    // **************************************************************************************
    // Debug: http://localhost:8000/system/categories/edit/1999/?masterPageSelect=layout-admin-main
    Route::get('/' . config('app.gSystemConfig.configRouteBackend') . '/' . config('app.gSystemConfig.configRouteBackendCategories') . '/' . config('app.gSystemConfig.configRouteBackendActionEdit') . '/{idTbCategories?}', [
            AdminCategoriesController::class, 'adminCategoriesEdit'
        ])
        ->name('admin.categories.edit');
    //Route::get('/' . $GLOBALS['configRouteBackend'] . '/' . $GLOBALS['configRouteBackendCategories'] . '/{idTbCategories?}',[AdminCategoriesController::class, 'adminCategoriesListing'])->name('admin.categories.listing');
    //Route::get('/admin/categories/{idParent?}',[AdminCategoriesController::class, 'getCategoriesListing'])->name('admin.categories.listing');
    // **************************************************************************************

    // Admin - Categories - edit - PUT.
    // TODO: reflect this pattern in node version.
    // **************************************************************************************
    // Debug: http://localhost:8000/system/categories/edit/1999/?masterPageSelect=layout-admin-main
    Route::put('/' . config('app.gSystemConfig.configRouteBackend') . '/' . config('app.gSystemConfig.configRouteBackendCategories') . '/' . config('app.gSystemConfig.configRouteBackendActionEdit') . '/{idTbCategories?}', [
            AdminCategoriesController::class, 'adminCategoriesUpdate'
        ])
        ->name('admin.categories.update');
    //Route::get('/' . $GLOBALS['configRouteBackend'] . '/' . $GLOBALS['configRouteBackendCategories'] . '/{idTbCategories?}',[AdminCategoriesController::class, 'adminCategoriesListing'])->name('admin.categories.listing');
    //Route::get('/admin/categories/{idParent?}',[AdminCategoriesController::class, 'getCategoriesListing'])->name('admin.categories.listing');
    // **************************************************************************************

    // Admin - Records - DELETE.
    // TODO: change to system/records
    // **************************************************************************************
    //Route::post('/' . $GLOBALS['configRouteBackend'] . '/' . $GLOBALS['configRouteBackendCategories'] . '/',[AdminCategoriesController::class, 'adminCategoriesInsert'])->name('admin.categories.insert');
    //Route::delete('/system/categories/',[AdminCategoriesController::class, 'adminCategoriesDelete'])->name('admin.categories.delete');
    Route::delete('/' . config('app.gSystemConfig.configRouteBackend') . '/' . config('app.gSystemConfig.configRouteBackendRecords') . '/', [
        AdminRecordsController::class, 'adminRecordsDelete'
    ])
    ->name('admin.records.delete');
    // **************************************************************************************
});
//});
// Route::get('/system/dashboard/',[AdminDashboardController::class, 'adminDashboard'])
//     ->name('admin.dashboard')
//     //->middleware('auth');
//     ->middleware('auth:sanctum');
