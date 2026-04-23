<?php

use App\Http\Controllers\Admin\Themes\NavCollectionController;

Route::controller(NavCollectionController::class)->group(function () {
    Route::get('navigation', 'collectionHomeView')->name('navigation');
    Route::get('navigation/{collection_id}/edit', 'editCollectionView')->name('navigation.edit');

    Route::get('navigation/{collection_id}/entries', 'entryHomeView')->name('navigation.entries');
    Route::get('navigation/{collection_id}/entries/create', 'createEntryView')->name('navigation.entries.create');
    Route::get('navigation/{collection_id}/entries/{entry_id}/edit', 'editEntryView')->name('navigation.entries.edit');
    
    Route::post('navigation', 'storeCollection')->name('navigation.store');
    Route::patch('navigation/{collection_id}/update', 'updateCollection')->name('navigation.update');
    Route::patch('navigation/{collection_id}/toggle', 'toggleCollection')->name('navigation.toggle');
    Route::post('navigation/sort', 'sortCollections')->name('navigation.sort');
    Route::delete('navigation/{collection_id}', 'destroyCollection')->name('navigation.destroy');

    Route::post('navigation/{collection_id}/entries', 'storeEntry')->name('navigation.entries.store');
    Route::patch('navigation/{collection_id}/entries/{entry_id}/update', 'updateEntry')->name('navigation.entries.update');
    Route::patch('navigation/entries/{entry_id}/toggle', 'toggleEntry')->name('navigation.entries.toggle');
    Route::post('navigation/entries/sort', 'sortEntries')->name('navigation.entries.sort');
    Route::delete('navigation/{collection_id}/entries/{entry_id}', 'destroyEntry')->name('navigation.entries.destroy');
});
