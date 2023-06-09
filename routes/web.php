<?php

use App\Http\Controllers\BatchingController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReceivingControlller;
use Illuminate\Support\Facades\Auth;
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

Auth::routes();

Route::group(['middleware' => ['auth']], function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/receiving', [ReceivingControlller::class, 'indexReceiving']);
    Route::put('/receiving/{id}', [ReceivingControlller::class, 'updateDataReceiving']);
    Route::get('/receiving/create', [ReceivingControlller::class, 'createReceiving']);
    Route::get('/receiving/data', [ReceivingControlller::class, 'getDataReceiving']);
    Route::post('/receiving/download', [ReceivingControlller::class, 'downloadReceiving']);
    Route::get('/receiving/{id}/edit', [ReceivingControlller::class, 'editDataReceiving']);
    Route::post('/receiving', [ReceivingControlller::class, 'storeReceiving']);
    Route::get('/receiving-success', [ReceivingControlller::class, 'successReceiving']);
    Route::get('/receiving/village/{id}', [ReceivingControlller::class, 'getVillage']);
    Route::get('/receiving/sls/{id}', [ReceivingControlller::class, 'getSls']);

    Route::get('/batching/data', [BatchingController::class, 'getDataBatching']);
    Route::resource('batching', BatchingController::class);
});
