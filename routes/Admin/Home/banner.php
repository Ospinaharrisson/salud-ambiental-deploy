<?php

use App\Http\Controllers\Admin\Home\BannerController;

Route::controller(BannerController::class)->group(function () {
    Route::get('banner', 'bannerHomeView')->name('banner');
    Route::get('banner/create', 'bannerCreateView')->name('banner.create');
    Route::get('banner/{id}/edit', 'bannerUpdateView')->name('banner.edit');

    Route::post('banner', 'storeBanner')->name('banner.store');
    Route::patch('banner/{id}/update', 'updateBanner')->name('banner.update');
    Route::patch('banner/{id}/toggle', 'toggleBanner')->name('banner.toggle');
    Route::post('banner/sort', 'sortBanner')->name('banner.sort');
    Route::delete('banner/{id}', 'destroyBanner')->name('banner.destroy');
});
