<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//AUTHENTICATION
Route::controller(\App\Http\Controllers\AuthenticationController::class)
    ->group(function () {

        Route::get('login', 'showFormLogin')->name('login');
        Route::post('login', 'handleLogin')->name('handleLogin');

        Route::get('register', 'showFormRegister')->name('register');
        Route::post('register', 'handleRegister')->name('handleRegister');

        Route::post('logout', 'handleLogout')->name('logout');

        Route::get('forgot-password', 'forgotPassword')->name('forgotPassword');
        Route::post('forgot-password', 'handleForgotPassword')->name('handleForgotPassword');
        Route::get('password/reset/{token}', 'showFormReset')->name('showFormReset');
        Route::post('password/reset/{token}', 'handleResetPassword')->name('handleResetPassword');

    });

Route::middleware('auth')
    ->group(function () {
        Route::middleware('role:admin,customer')
            ->group(function () {
                Route::get('dashboard', [\App\Http\Controllers\CustomerController::class, 'dashboard'])->name('customer.dashboard');
                Route::get('profile', [\App\Http\Controllers\CustomerController::class, 'profile'])->name('customer.profile');
            });

        Route::get('employee/dashboard', [\App\Http\Controllers\EmployeeController::class, 'dashboard'])->name('employee.dashboard')
            ->middleware('role:employee');

        Route::get('admin/dashboard', [\App\Http\Controllers\AdminController::class, 'dashboard'])->name('admin.dashboard')
            ->middleware('role:admin');


        Route::middleware('role:admin,employee')
            ->group(function () {
                Route::get('orders', [\App\Http\Controllers\OrderController::class, 'index'])->name('orders.index');
            });


        Route::get('movies', [\App\Http\Controllers\MovieController::class, 'index'])->name('movies.index')
            ->middleware(\App\Http\Middleware\checkUpper18::class);
    });






// Admin
