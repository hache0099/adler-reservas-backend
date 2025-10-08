<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
	$request->fulfill();
	dd($request);
	// ESTA RUTA SOLO SE LLAMA SI TU FRONTEND REDIRIGE AL BACKEND
	// En un flujo SPA, es mejor devolver un JSON.
	// Pero para que la URL se genere, la ruta debe existir.
	// Lo ideal es redirigir de vuelta al frontend.
	return response()->json(['Se ha verificado con éxito', 200]);
})->middleware(['signed'])->name('verification.verify');