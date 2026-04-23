<?php

use App\Http\Controllers\Admin\Home\CollectionPointController;

Route::controller(CollectionPointController::class)->group(function () {
    Route::get('collection', 'collectionHomeView')->name('collection');
    Route::get('collection/create', 'collectionCreateView')->name('collection.create');
    Route::get('collection/{id}/edit', 'collectionUpdateView')->name('collection.edit');

    Route::post('collection', 'storeCollection')->name('collection.store');
    Route::patch('collection/{id}/update', 'updateCollection')->name('collection.update');
    Route::patch('collection/{id}/toggle','toggleCollection')->name('collection.toggle');
    Route::post('collection/sort', 'sortCollection')->name('collection.sort');
    Route::delete('collection/{id}', 'destroyCollection')->name('collection.destroy');
});