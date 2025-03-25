<?php

use Illuminate\Support\Facades\Route;
use Modules\UserModule\Http\Controllers\UserModuleController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('usermodule', UserModuleController::class)->names('usermodule');
});
