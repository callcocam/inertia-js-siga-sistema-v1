<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

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
if(!app()->runningInConsole()){
    // Auth
    Route::prefix(app('currentTenant')->prefix)->middleware(app('currentTenant')->middleware)->group(function () {


        include "auth.php";


// Dashboard
        Route::get('/', [DashboardController::class, 'index'])
            ->name('dashboard')
            ->middleware('auth');

        Route::resourceAndRestore('tenants', TenantController::class)
            ->middleware('auth');


        Route::resourceAndRestore('users', UsersController::class)
            ->middleware('auth');
    });
}

