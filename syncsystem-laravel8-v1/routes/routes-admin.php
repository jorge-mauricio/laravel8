<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
// Controllers.
use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\AdminDashboardController;

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

// Protected routes (user admin).
//Route::group(['middleware' => 'setHeaders.token.web'], function () {
    //Route::group(['middleware' => 'auth:sanctum'], function () {
Route::group(
    [
        'middleware' => [
            'setHeaders.token.web:' . config('app.gSystemConfig.configCookiePrefixUserAdmin'),
            'auth:sanctum'
        ]
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
    }
);
