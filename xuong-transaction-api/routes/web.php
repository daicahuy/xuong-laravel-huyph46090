<?php

use App\Http\Controllers\TransactionController;
use App\Http\Middleware\CheckTransactionExist;
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
})->name('home');

Route::controller(TransactionController::class)
    ->prefix('transaction')
    ->name('transaction.')
    ->group(function () {

        Route::get('/', 'index')->name('index');


        Route::get('/step1', 'step1')->name('step1');
        Route::post('/step1', 'handleStep1')->name('handleStep1');
        Route::get('/step2', 'step2')->name('step2');
        Route::post('/step2', 'handleStep2')->name('handleStep2');
        Route::get('/step3', 'step3')->name('step3');
        Route::post('/step3', 'handleStep3')->name('handleStep3');
        Route::get('/success', 'success')->name('success');


        Route::post('/cancel', 'cancel')->name('cancel');
        Route::post('/continue', 'continue')->name('continue');

        Route::get('/list-unfinished', 'listUnfinished')->name('listUnfinished');
    });
