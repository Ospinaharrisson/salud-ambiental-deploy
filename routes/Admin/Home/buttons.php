<?php

use App\Http\Controllers\Admin\Home\AppButtonController;

Route::controller(AppButtonController::class)->group(function () {
    Route::get('app', 'appButtonHomeView')->name('app');
    Route::get('app/create', 'appButtonCreateView')->name('app.create');
    Route::get('app/{id}/edit', 'appButtonUpdateView')->name('app.edit');

    Route::post('app', 'storeAppButton')->name('app.store');
    Route::patch('app/{id}/update', 'updateAppButton')->name('app.update');
    Route::patch('app/{id}/toggle', 'toggleAppButton')->name('app.toggle');
    Route::post('app/sort', 'sortAppButton')->name('app.sort');
    Route::delete('app/{id}', 'destroyAppButton')->name('app.destroy');
});
