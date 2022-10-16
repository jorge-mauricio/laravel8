<?php

use Illuminate\Support\Facades\Route;

// Controllers.
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
Route::get('/categories/{idTbCategories?}',[FrontendCategoriesListingController::class, '__construct'])->name('categories.listing'); // Inside Laravel, you can redirect to route like: {{ route('categories.listing') }}
// **************************************************************************************

/*
use App\Http\Controllers\OrderController;
 
Route::controller(OrderController::class)->group(function () {
    Route::get('/orders/{id}', 'show');
    Route::post('/orders', 'store');
});
*/

// Admin - Categories - listing - GET.
// **************************************************************************************
// Debug: http://127.0.0.1:8000/admin/categories/123
// Debug: http://127.0.0.1:8000/admin/categories/781
// Debug: http://localhost:8000/system/categories/781
Route::get('/system/categories/{idTbCategories?}',[AdminCategoriesController::class, 'adminCategoriesListing'])->name('admin.categories.listing');
//Route::get('/' . $GLOBALS['configRouteBackend'] . '/' . $GLOBALS['configRouteBackendCategories'] . '/{idTbCategories?}',[AdminCategoriesController::class, 'adminCategoriesListing'])->name('admin.categories.listing');
//Route::get('/admin/categories/{idParent?}',[AdminCategoriesController::class, 'getCategoriesListing'])->name('admin.categories.listing');
// **************************************************************************************


// Admin - Categories - POST (insert record).
// **************************************************************************************
//Route::post('/' . $GLOBALS['configRouteBackend'] . '/' . $GLOBALS['configRouteBackendCategories'] . '/',[AdminCategoriesController::class, 'adminCategoriesInsert'])->name('admin.categories.insert');
Route::post('/system/categories/',[AdminCategoriesController::class, 'adminCategoriesInsert'])->name('admin.categories.insert'); // working
// **************************************************************************************


// Admin - Categories - POST (insert record).
// TODO: change to system/records
// **************************************************************************************
//Route::post('/' . $GLOBALS['configRouteBackend'] . '/' . $GLOBALS['configRouteBackendCategories'] . '/',[AdminCategoriesController::class, 'adminCategoriesInsert'])->name('admin.categories.insert');
//Route::delete('/system/categories/',[AdminCategoriesController::class, 'adminCategoriesDelete'])->name('admin.categories.delete');
Route::delete('/system/records/',[AdminRecordsController::class, 'adminRecordsDelete'])->name('admin.records.delete');
// **************************************************************************************
