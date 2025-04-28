<?php

use Illuminate\Support\Facades\Route;
use Modules\Cancha\Http\Controllers\CanchaController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('cancha', CanchaController::class)->names('cancha');
});
