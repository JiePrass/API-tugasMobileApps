<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\SiswaController;

Route::get('/siswa', [SiswaController::class, 'index']);

Route::post('/siswa', [SiswaController::class, 'insert']);

Route::delete('/siswa/{nis}', [SiswaController::class, 'delete']);

Route::put('/siswa/{nis}', [SiswaController::class, 'update']);
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
