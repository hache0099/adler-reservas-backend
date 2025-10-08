<?php

use Illuminate\Support\Facades\Route;
use Modules\Socio\Http\Controllers\SocioController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('socio', SocioController::class)->names('socio');
});
