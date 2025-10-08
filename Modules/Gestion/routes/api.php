<?php

use Illuminate\Support\Facades\Route;
use Modules\Gestion\Http\Controllers\{GestionController, PerfilController,TiposDocumentoController, TiposContactoController, TiposDomicilioController, TiposCanchaController, MedioPagoMembresiaController, MedioPagoReservaController, SocioGestionController};

Route::prefix('v1/gestion')->group(function () {
    Route::get('/tipos-documento', [GestionController::class, 'getTiposDocumento']);
    Route::get('/tipos-domicilio', [GestionController::class, 'getTiposDomicilio']);
    Route::get('/tipos-contacto', [GestionController::class, 'getTiposContacto']);
    Route::get('/tipos-cancha', [GestionController::class, 'getTiposCancha']);
    Route::get('/get-modulos', [GestionController::class, 'getModulos']);
    Route::get('/get-all-modulos', [GestionController::class, 'getAllModulos']);
    Route::get('/get-perfiles',[GestionController::class, 'getPerfiles']);
    Route::post('/pagos/confirmar-efectivo', [SocioGestionController::class, 'confirmarPagoEfectivo']);
    
});

Route::prefix('v1/admin')->group(function () {
    Route::apiResource('tipos-documento', TiposDocumentoController::class)->names('tipos-documento');
    Route::apiResource('tipos-contacto', TiposContactoController::class)->names('tipos-contacto');
    Route::apiResource('tipos-domicilio', TiposDomicilioController::class)->names('tipos-domicilio');
    Route::apiResource('tipos-cancha', TiposCanchaController::class)->names('tipos-cancha');
    Route::apiResource('perfil', PerfilController::class)->names('perfil');
    Route::apiResource('socios', SocioGestionController::class)->names('socio');
	Route::apiResource('medios-pago-membresias', MedioPagoMembresiaController::class);
	Route::apiResource('medio-pago-reserva', MedioPagoReservaController::class);
});
