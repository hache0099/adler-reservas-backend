<?php

use Illuminate\Support\Facades\Route;
use Modules\Reserva\Http\Controllers\ReservaController;

Route::prefix('v1/reservas')->group(function () {
    Route::apiResource('reserva', ReservaController::class)->names('reserva');
    
    Route::get('/{id}/get-pendientes', [ReservaController::class, 'getReservaPendienteByUser']);
    Route::get('/get-canchas-disponibles',[ReservaController::class, 'getCanchasDisponibles']);
});
