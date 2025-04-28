<?php

use Illuminate\Support\Facades\Route;
use Modules\Gestion\Http\Controllers\{GestionController, PerfilController,TiposDocumentoController, TiposContactoController, TiposDomicilioController, TiposCanchaController};

Route::prefix('v1/gestion')->group(function () {
    Route::get('/tipos-documento', [GestionController::class, 'getTiposDocumento']);
    Route::get('/tipos-domicilio', [GestionController::class, 'getTiposDomicilio']);
    Route::get('/tipos-contacto', [GestionController::class, 'getTiposContacto']);
    Route::get('/tipos-cancha', [GestionController::class, 'getTiposCancha']);
    Route::get('/get-modulos', [GestionController::class, 'getModulos']);
    Route::get('/get-all-modulos', [GestionController::class, 'getAllModulos']);
    
});

Route::prefix('v1/admin')->group(function () {
    Route::apiResource('tipos-documento', TiposDocumentoController::class)->names('tipos-documento');
    Route::apiResource('tipos-contacto', TiposContactoController::class)->names('tipos-contacto');
    Route::apiResource('tipos-domicilio', TiposDomicilioController::class)->names('tipos-domicilio');
    Route::apiResource('tipos-cancha', TiposCanchaController::class)->names('tipos-cancha');
    Route::apiResource('perfil', PerfilController::class)->names('perfil');
});
