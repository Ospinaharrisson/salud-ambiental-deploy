<?php   

use App\Http\Controllers\Admin\Themes\ModuleBannerController;

Route::controller(ModuleBannerController::class)->group(function () {
    Route::get('banner', 'bannerHomeView')->name('banner');
    Route::post('banner/create', 'storeBanner')->name('banner.store');
    Route::patch('banner/{banner_id}/update', 'updateBanner')->name('banner.update');
});