<?php

use App\Http\Controllers\Admin\Home\FeaturedImageController;

Route::controller(FeaturedImageController::class)->group(function () {
    Route::get('featured', 'featuredHomeView')->name('featured');
    Route::get('featured/create', 'featuredCreateView')->name('featured.create');
    Route::get('featured/{id}/edit', 'featuredUpdateView')->name('featured.edit');

    Route::post('featured', 'storeFeatured')->name('featured.store');
    Route::patch('featured/{id}/update', 'updateFeatured')->name('featured.update');
    Route::patch('featured/{id}/toggle', 'toggleFeatured')->name('featured.toggle');
    Route::post('featured/sort', 'sortFeatured')->name('featured.sort');
    Route::delete('featured/{id}', 'destroyFeatured')->name('featured.destroy');
});
