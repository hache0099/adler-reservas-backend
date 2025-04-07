<?php

use Illuminate\Support\Facades\Route;
use Modules\UserModule\Http\Controllers\UserModuleController;

Route::middleware('auth:sanctum')->prefix('v1')->group(function () {
    Route::apiResource('user', UserModuleController::class)->names('user');
});
