<?php

use Illuminate\Support\Facades\Route;
use Modules\Membresia\Http\Controllers\MembresiaController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('membresia', MembresiaController::class)->names('membresia');
});
