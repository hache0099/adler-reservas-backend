<?php

use Illuminate\Support\Facades\Route;
use Modules\Cancha\Http\Controllers\CanchaController;

Route::prefix('v1')->group(function () {
    Route::apiResource('cancha', CanchaController::class)->names('cancha');
});
