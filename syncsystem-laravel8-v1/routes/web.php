<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
// Controllers.
use App\Http\Controllers\FrontendHomeController;
use App\Http\Controllers\FrontendCategoriesListingController;
use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminRecordsController;
use App\Http\Controllers\AdminUsersController;

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

// Admin - Home - Login.
// **************************************************************************************
// Route::get('/system/',[AdminLoginController::class, 'adminLogin'])->name('admin.login');
Route::get(
    '/' . config('app.gSystemConfig.configRouteBackend') . '/',
    [
        AdminLoginController::class, 'adminLogin'
    ]
)
    ->name(config('app.gSystemConfig.configRouteBackend'));
    // ->name('admin');
// **************************************************************************************

// Admin - Login - POST (check username and password).
// **************************************************************************************
// Route::post('/system/login/',[AdminLoginController::class, 'adminLoginCheck'])->name('admin.login.check');
Route::post(
    '/' . config('app.gSystemConfig.configRouteBackend') . '/' . config('app.gSystemConfig.configRouteBackendLogin') . '/',
    [
        AdminLoginController::class, 'adminLoginCheck'
    ]
)
    ->name(config('app.gSystemConfig.configRouteBackend') . '.' . config('app.gSystemConfig.configRouteBackendLogin'));
// **************************************************************************************

// Protected routes.
//Route::group(['middleware' => 'setHeaders.token.web'], function () {
    //Route::group(['middleware' => 'auth:sanctum'], function () {
Route::group(
    [
        'middleware' => ['setHeaders.token.web', 'auth:sanctum']
    ],
    function () {
        // TODO: make auth sanctum conditioned to $GLOBALS['configRegistersAuthenticationType'] === 11
        //Route::group(['middleware' => ['auth:sanctum', 'setHeaders.token.web']], function () {

        // Admin - Logoff - POST.
        // **************************************************************************************
        // Route::get('/system/logoff/', [AdminLoginController::class, 'adminLogoff'])->name('admin.logoff');
        Route::get(
            '/' . config('app.gSystemConfig.configRouteBackend') . '/' . config('app.gSystemConfig.configRouteBackendLogOff') . '/',
            [
                AdminLoginController::class, 'adminLogoff'
            ]
        )
            ->name(config('app.gSystemConfig.configRouteBackend') . '.' . config('app.gSystemConfig.configRouteBackendLogOff'));
        // **************************************************************************************

        // Admin - Dashboard.
        // **************************************************************************************
        // Route::get('/system/dashboard/', [AdminDashboardController::class, 'adminDashboard'])->name('admin.dashboard');
        Route::get(
            '/' . config('app.gSystemConfig.configRouteBackend') . '/' . config('app.gSystemConfig.configRouteBackendDashboard') . '/',
            [
                AdminDashboardController::class, 'adminDashboard'
            ]
        )
            ->name(config('app.gSystemConfig.configRouteBackend') . '.' . config('app.gSystemConfig.configRouteBackendDashboard'));
        // Route::get('/system/dashboard/',[AdminDashboardController::class, 'adminDashboard'])->name('admin.dashboard')->middleware('setHeaders.token.web');

        // Testing architecture.
        // Route::get('/system/dashboard/',[AdminDashboardController::class, 'adminDashboard'], function($request) {
        //     return view('admin.dashboard', [
        //         'clients' => $request->user()->clients
        //     ]);
        // })->middleware(['auth'])->name('admin.dashboard');
        // TODO: evaluate changing the architecture - return the data from the classes and bind with the views in the route´s functions.
        // **************************************************************************************

        // Categories - import from external routes file.
        // ----------------------
        // Admin.
        require_once 'routes-admin-categories.php';
        // ----------------------

        // Admin - Records - DELETE.
        // TODO: change to system/records
        // **************************************************************************************
        //Route::post('/' . $GLOBALS['configRouteBackend'] . '/' . $GLOBALS['configRouteBackendCategories'] . '/',[AdminCategoriesController::class, 'adminCategoriesInsert'])->name('admin.categories.insert');
        //Route::delete('/system/categories/',[AdminCategoriesController::class, 'adminCategoriesDelete'])->name('admin.categories.delete');
        Route::delete(
            '/' . config('app.gSystemConfig.configRouteBackend') . '/' . config('app.gSystemConfig.configRouteBackendRecords') . '/',
            [
                AdminRecordsController::class, 'adminRecordsDelete'
            ]
        )
            ->name(config('app.gSystemConfig.configRouteBackend') . '.' . config('app.gSystemConfig.configRouteBackendRecords'));
            // ->name('admin.records.delete');
        // **************************************************************************************
    }
);
//});
// Route::get('/system/dashboard/',[AdminDashboardController::class, 'adminDashboard'])
//     ->name('admin.dashboard')
//     //->middleware('auth');
//     ->middleware('auth:sanctum');


// TODO: another middleware for root auth
// Admin - Users - listing - GET.
// **************************************************************************************
Route::get(
    '/' . config('app.gSystemConfig.configRouteBackend') . '/' . config('app.gSystemConfig.configRouteBackendUsers') . '/{idParent?}',
    [
        AdminUsersController::class, 'adminUsersListing'
    ]
)
    ->name(config('app.gSystemConfig.configRouteBackend') . '.' . config('app.gSystemConfig.configRouteBackendUsers'));
// **************************************************************************************

// Admin - Users - POST (insert record).
// **************************************************************************************
Route::post(
    '/' . config('app.gSystemConfig.configRouteBackend') . '/' . config('app.gSystemConfig.configRouteBackendUsers') . '/',
    [
        AdminUsersController::class, 'adminUsersInsert'
    ]
)
    ->name(
        config('app.gSystemConfig.configRouteBackend') . '.' .
        config('app.gSystemConfig.configRouteBackendUsers') . '.' .
        'insert'
    );
// **************************************************************************************

// Admin - Users - edit - GET.
// **************************************************************************************
// Debug: http://localhost:8000/admin/users/edit/2026/?masterPageSelect=layout-admin-main
Route::get(
    '/' . config('app.gSystemConfig.configRouteBackend') . '/' . config('app.gSystemConfig.configRouteBackendUsers') . '/' . config('app.gSystemConfig.configRouteBackendActionEdit') . '/{idTbUsers?}',
    [
        AdminUsersController::class, 'adminUsersEdit'
    ]
)
    ->name(
        config('app.gSystemConfig.configRouteBackend') . '.' .
        config('app.gSystemConfig.configRouteBackendUsers') . '.' .
        config('app.gSystemConfig.configRouteBackendActionEdit')
    );
// **************************************************************************************

// Admin - Users - edit - PUT.
// TODO: reflect this pattern in node version.
// **************************************************************************************
// Debug: http://localhost:8000/admin/users/edit/1999/?masterPageSelect=layout-admin-main
Route::put(
    '/' . config('app.gSystemConfig.configRouteBackend') . '/' . config('app.gSystemConfig.configRouteBackendUsers') . '/' . config('app.gSystemConfig.configRouteBackendActionEdit') . '/{idTbUsers?}',
    [
        AdminUsersController::class, 'adminUsersUpdate'
    ]
)
    ->name(
        config('app.gSystemConfig.configRouteBackend') . '.' .
        config('app.gSystemConfig.configRouteBackendUsers') . '.' .
        config('app.gSystemConfig.configRouteBackendActionEdit')
    );
    // ->name('admin.categories.update');
// **************************************************************************************
