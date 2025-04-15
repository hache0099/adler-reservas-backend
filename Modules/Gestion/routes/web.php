<?php

use Illuminate\Support\Facades\Route;
use Modules\Gestion\Http\Controllers\GestionController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('gestion', GestionController::class)->names('gestion');
});
