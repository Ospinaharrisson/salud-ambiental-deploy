<?php

use App\Http\Controllers\Admin\Themes\ModuleButtonController;

Route::controller(ModuleButtonController::class)->group(function () {
    Route::get('buttons', 'buttonsHomeView')->name('buttons');
    Route::get('buttons/create', 'createButtonView')->name('buttons.create');
    Route::get('buttons/{button_id}/edit', 'editButtonView')->name('buttons.edit');
    
    Route::post('buttons', 'storeButton')->name('buttons.store');
    Route::patch('buttons/{button_id}/update', 'updateButton')->name('buttons.update');
    Route::patch('buttons/{button_id}/toggle', 'toggleButton')->name('buttons.toggle');
    Route::post('buttons/sort', 'sortButtons')->name('buttons.sort');
    Route::delete('buttons/{button_id}', 'destroyButton')->name('buttons.destroy');
});
