<?php

use Illuminate\Support\Facades\Route;
use Modules\Reserva\Http\Controllers\ReservaController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('reserva', ReservaController::class)->names('reserva');
});
