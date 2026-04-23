<?php

use App\Http\Controllers\Admin\Themes\PageController;

Route::controller(PageController::class)->group(function () {
    Route::get('page', 'pageHomeView')->name('page');
    Route::get('page/create', 'pageCreateView')->name('page.create');
    Route::get('page/{page_id}/edit', 'pageUpdateView')->name('page.edit');

    Route::post('page', 'storePage')->name('page.store');
    Route::patch('page/{page_id}/update', 'updatePage')->name('page.update');
    Route::patch('page/{page_id}/toggle','togglePage')->name('page.toggle');
    Route::post('page/sort', 'sortPages')->name('page.sort');
    Route::delete('page/{page_id}', 'destroyPage')->name('page.destroy');
});