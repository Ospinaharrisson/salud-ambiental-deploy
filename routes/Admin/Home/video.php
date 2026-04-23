<?php

use App\Http\Controllers\Admin\Home\HomeVideoController;

Route::controller(HomeVideoController::class)->group(function () {
    Route::get('video', 'videoHomeView')->name('video');

    Route::post('video/create', 'storeVideo')->name('video.store');
    Route::patch('video/{id}/update', 'updateVideo')->name('video.update');
});