<?php

use App\Http\Controllers\Admin\Home\GalleryEventController;

Route::controller(GalleryEventController::class)->group(function () {
    Route::get('gallery', 'galleryHomeView')->name('gallery');
    Route::get('gallery/create', 'galleryCreateView')->name('gallery.create');
    Route::get('gallery/{event_id}/edit', 'galleryUpdateView')->name('gallery.edit');

    Route::get('gallery/{event_id}/images', 'galleryImageView')->name('gallery.images');
    Route::get('gallery/{event_id}/images/create', 'galleryImageCreateView')->name('gallery.images.create');
    Route::get('gallery/{event_id}/images/{image_id}/edit', 'galleryImageUpdateView')->name('gallery.images.edit');

    Route::post('gallery', 'storeGallery')->name('gallery.store');
    Route::patch('gallery/{event_id}/update', 'updateGallery')->name('gallery.update');
    Route::patch('gallery/{event_id}/toggle', 'toggleGallery')->name('gallery.toggle');
    Route::post('gallery/sort', 'sortGallery')->name('gallery.sort');        
    Route::delete('gallery/{event_id}', 'destroyGallery')->name('gallery.destroy');

    Route::post('gallery/{event_id}', 'storeGalleryImage')->name('gallery.images.store');
    Route::patch('gallery/{event_id}/images/{image_id}/update', 'updateGalleryImage')->name('gallery.images.update');
    Route::patch('gallery/{event_id}/images/{image_id}/toggle', 'toggleGalleryImage')->name('gallery.images.toggle');
    Route::post('gallery/images/sort', 'sortGalleryImage')->name('gallery.images.sort');
    Route::delete('gallery/{event_id}/images/{image_id}', 'destroyGalleryImage')->name('gallery.images.destroy');
});
