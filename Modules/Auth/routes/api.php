<?php

use Illuminate\Support\Facades\Route;
use Modules\Auth\Http\Controllers\AuthController;

Route::prefix('v1/auth')->group(function () {
    Route::apiResource('auth', AuthController::class)->names('auth');
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
    Route::get('/user', [AuthController::class, 'user'])->middleware('auth:sanctum');
    Route::post('/register', [AuthController::class, 'register']);


    Route::get('/get-tablas-maestras', [AuthController::class, 'getTablasMaestras']);
    Route::get('/get-tipo-documento', [AuthController::class, 'getTiposDocumento']);
    Route::post('/check-email', [AuthController::class, 'checkEmailExists']);
});


