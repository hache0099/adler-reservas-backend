<?php

use Illuminate\Support\Facades\Route;
use Modules\Reserva\Http\Controllers\ReservaController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('reserva', ReservaController::class)->names('reserva');
});
