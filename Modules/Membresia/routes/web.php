<?php

use Illuminate\Support\Facades\Route;
use Modules\Membresia\Http\Controllers\MembresiaController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('membresia', MembresiaController::class)->names('membresia');
});
