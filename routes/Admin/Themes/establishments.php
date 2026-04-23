<?php

use App\Http\Controllers\Admin\Themes\AccreditedController;
use App\Http\Controllers\Admin\Themes\FavorableController;

Route::controller(AccreditedController::class)->group(function () {
    Route::get('accredited', 'accreditedHomeView')->name('accredited');
    Route::get('accredited/create', 'createAccreditedView')->name('accredited.create');
    Route::get('accredited/{accredited_id}/edit', 'editAccreditedView')->name('accredited.edit');

    Route::post('accredited', 'storeAccredited')->name('accredited.store');
    Route::patch('accredited/{accredited_id}/update', 'updateAccredited')->name('accredited.update');
    Route::patch('accredited/{accredited_id}/toggle', 'toggleAccredited')->name('accredited.toggle');
    Route::post('accredited/sort', 'sortAccredited')->name('accredited.sort');
    Route::delete('accredited/{accredited_id}', 'destroyAccredited')->name('accredited.destroy');
});

Route::controller(FavorableController::class)->group(function () {
    Route::get('favorable', 'favorableHomeView')->name('favorable');
    Route::get('favorable/create', 'createFavorableView')->name('favorable.create');
    Route::get('favorable/{favorable_id}/edit', 'editFavorableView')->name('favorable.edit');

    Route::post('favorable', 'storeFavorable')->name('favorable.store');
    Route::patch('favorable/{favorable_id}/update', 'updateFavorable')->name('favorable.update');
    Route::patch('favorable/{favorable_id}/toggle', 'toggleFavorable')->name('favorable.toggle');
    Route::post('favorable/sort', 'sortFavorable')->name('favorable.sort');
    Route::delete('favorable/{favorable_id}', 'destroyFavorable')->name('favorable.destroy');
});