<?php

use Illuminate\Support\Facades\Route;
use Modules\Gestion\Http\Controllers\GestionController;

Route::prefix('v1/gestion')->group(function () {
    Route::get('/tipos-documento', [GestionController::class, 'getTiposDocumento']);
    Route::get('/tipos-domicilio', [GestionController::class, 'getTiposDomicilio']);
    Route::get('/tipos-contacto', [GestionController::class, 'getTiposContacto']);
});
