<?php

use App\Http\Controllers\Admin\Home\HomePageController;

Route::controller(HomePageController::class)->group(function () {
    Route::get('page', 'pageHomeView')->name('page');
    Route::get('page/create', 'pageCreateView')->name('page.create');
    Route::get('page/{id}/edit', 'pageEditView')->name('page.edit');

    Route::post('page', 'storePage')->name('page.store');
    Route::patch('page/{id}/update', 'updatePage')->name('page.update');
    Route::patch('page/{id}/toggle', 'togglePage')->name('page.toggle');
    Route::delete('page/{id}', 'destroyPage')->name('page.destroy');
});

