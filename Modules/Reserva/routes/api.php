<?php

use Illuminate\Support\Facades\Route;
use Modules\Reserva\Http\Controllers\ReservaController;

Route::prefix('v1/reservas')->group(function () {
    Route::apiResource('reserva', ReservaController::class)->names('reserva');
    
    Route::get('/{id}/get-pendientes', [ReservaController::class, 'getReservaPendienteByUser']);
    Route::get('/{id}/get-all-reservas', [ReservaController::class, 'getTodasReservasByUser']);
    Route::get('/get-canchas-disponibles',[ReservaController::class, 'getCanchasDisponibles']);

    Route::get('/reservas-por-fecha',[ ReservaController::class, 'getReservasByDate']);
});
