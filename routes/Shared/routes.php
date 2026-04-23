<?php

use App\Http\Controllers\Shared\RouteController;

Route::controller(RouteController::class)->group(function () {
    Route::get('/blank/show/{key}', 'show')->name('blank.view');
    Route::post('/blank/generate', 'generate')->name('blank.generate');
});
