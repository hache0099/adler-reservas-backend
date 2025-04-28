<?php

use Illuminate\Support\Facades\Route;
use Modules\UserModule\Http\Controllers\UserModuleController;

Route::prefix('v1')->group(function () {
    Route::apiResource('user', UserModuleController::class)->names('user');
    Route::put('/user/update-personal-info/{id}', [UserModuleController::class, 'updatePersonalInfo']);
});
