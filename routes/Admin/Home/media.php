<?php

use App\Http\Controllers\Admin\Home\MediaGalleryController;

Route::controller(MediaGalleryController::class)->group(function () {
    Route::get('media', 'mediaHomeView')->name('media');
    Route::get('media/create', 'mediaCreateView')->name('media.create');
    Route::get('media/{id}/edit', 'mediaUpdateView')->name('media.edit');

    Route::post('media', 'storeMedia')->name('media.store');
    Route::patch('media/{id}/update', 'updateMedia')->name('media.update');
    Route::patch('media/{id}/toggle', 'toggleMedia')->name('media.toggle');
    Route::post('media/sort', 'sortMedia')->name('media.sort');
    Route::delete('media/{id}', 'destroyMedia')->name('media.destroy');
});
