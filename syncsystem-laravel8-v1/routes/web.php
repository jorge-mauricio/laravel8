<?php

use Illuminate\Support\Facades\Route;

// Controllers.
use App\Http\Controllers\AdminCategoriesController;
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


// Admin - Categories - listing - GET.
// **************************************************************************************
// Debug: http://127.0.0.1:8000/admin/categories/123
//Route::get('/admin/categories/{idTbCategories?}',[AdminCategoriesController::class, 'adminCategoriesListing'])->name('admin.categories.listing');
Route::get('/admin/categories/{idParent?}',[AdminCategoriesController::class, 'getCategoriesListing'])->name('admin.categories.listing');
// **************************************************************************************
