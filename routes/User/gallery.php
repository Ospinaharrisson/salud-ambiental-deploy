<?php

use App\Http\Controllers\User\GalleryRenderController;

Route::controller(GalleryRenderController::class)->group(function() {
    Route::get('/galerias', 'index')->name('galleries.index');
    Route::get('/galerias/{id}', 'show')->name('galleries.show');
});
