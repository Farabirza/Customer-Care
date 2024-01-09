<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KeluhanPelangganController;

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

Route::get('/', [HomeController::class, 'index'])->name('home')->middleware('auth');

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');
Route::resource('/keluhanPelanggan', KeluhanPelangganController::class)->middleware('auth');
Route::get('/keluhanPelanggan/export/{format}', [KeluhanPelangganController::class, 'export'])->middleware('auth');

Route::group([
    'middleware' => ['auth'],
    'prefix' => 'action'
    ], function () {
    Route::post('/keluhanPelanggan', [KeluhanPelangganController::class, 'action']);
});

Auth::routes();

// Route::get('/{any}', [App\Http\Controllers\HomeController::class, 'index'])
//     ->where('any', '.*')
//     ->name('home');
