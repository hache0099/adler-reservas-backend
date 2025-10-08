<?php

use Illuminate\Support\Facades\Route;
use Modules\Socio\Http\Controllers\MembresiaController;

Route::prefix('v1/membresias')->group(function () {
    
     Route::get('/historial-pagos', [MembresiaController::class, 'getHistorialPagos']);
    Route::post('/subscribe', [MembresiaController::class, 'subscribe']);
    Route::get('/status', [MembresiaController::class, 'status']);
    Route::get('/precio-actual', [MembresiaController::class, 'getPrecioActual']);
});
