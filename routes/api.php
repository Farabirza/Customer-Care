<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KeluhanPelangganController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/keluhanPelanggan', [KeluhanPelangganController::class, 'index_api']);
Route::post('/keluhanPelanggan/{keluhanPelanggan_id}/update_status', [KeluhanPelangganController::class, 'update_status']);
Route::post('/keluhanPelanggan/{keluhanPelanggan_id}/delete_status', [KeluhanPelangganController::class, 'delete_status']);
