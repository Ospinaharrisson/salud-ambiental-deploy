<?php

use App\Http\Controllers\Admin\Home\LineOfInterestController;

Route::controller(LineOfInterestController::class)->group(function () {
    Route::get('line', 'lineHomeView')->name('line');
    Route::get('line/create', 'lineCreateView')->name('line.create');
    Route::get('line/{id}/edit', 'lineUpdateView')->name('line.edit');

    Route::post('line', 'storeLine')->name('line.store');
    Route::patch('line/{id}/update', 'updateLine')->name('line.update');
    Route::patch('line/{id}/toggle', 'toggleLine')->name('line.toggle');
    Route::post('line/sort', 'sortLine')->name('line.sort');
    Route::delete('line/{id}', 'destroyLine')->name('line.destroy');
});
