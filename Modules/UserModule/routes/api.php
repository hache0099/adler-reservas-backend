<?php

use Illuminate\Support\Facades\Route;
use Modules\UserModule\Http\Controllers\UserModuleController;

Route::prefix('v1')->group(function () {
    Route::apiResource('user', UserModuleController::class)->names('user');
    Route::put('/user/update-personal-info/{id}', [UserModuleController::class, 'updatePersonalInfo']);
    Route::put('/user/{id}/update-perfil',[UserModuleController::class, 'updatePerfil']);
    Route::put('/change-password', [UserModuleController::class, 'changePassword']);
    Route::post('/user/{id}/toggle-user', [UserModuleController::class, 'updateEstado']);
});
