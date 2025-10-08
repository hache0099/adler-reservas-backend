<?php

use Illuminate\Support\Facades\Route;
use Modules\Auth\Http\Controllers\AuthController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

Route::prefix('v1/auth')->group(function () {
    Route::apiResource('auth', AuthController::class)->names('auth');
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'user'])->middleware('auth:sanctum');
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/user/{id}/reset-password', [AuthController::class, 'resetUserPassword']);
    Route::post('/forgot-password', [AuthController::class, 'sendPasswordEmail']);
    Route::post('/reset-password', [AuthController::class, 'resetPassword']);

	

	  Route::post('/email/resend-verification', [AuthController::class, 'resendVerificationEmail'])
	  ->name('verification.custom_resend');
    // ...
    // Ruta que recibe el clic del correo
    Route::get('/verify-email/{token}', [AuthController::class, 'verifyEmail'])
    ->name('verification.custom_verify');


    Route::get('/get-tablas-maestras', [AuthController::class, 'getTablasMaestras']);
    Route::get('/get-tipo-documento', [AuthController::class, 'getTiposDocumento']);
    Route::post('/check-email', [AuthController::class, 'checkEmailExists']);
});


