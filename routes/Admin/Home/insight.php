<?php

use App\Http\Controllers\Admin\Home\WeatherInsightController;

Route::controller(WeatherInsightController::class)->group(function () {
    Route::get('insight', 'insightHomeView')->name('insight');
    Route::get('insight/create', 'insightCreateView')->name('insight.create');
    Route::get('insight/{id}/edit', 'insightUpdateView')->name('insight.edit');

    Route::post('insight', 'storeInsight')->name('insight.store');
    Route::patch('insight/{id}/update', 'updateInsight')->name('insight.update');
    Route::patch('insight/{id}/toggle', 'toggleInsight')->name('insight.toggle');
    Route::post('insight/sort', 'sortInsight')->name('insight.sort');
    Route::delete('insight/{id}', 'destroyInsight')->name('insight.destroy');
});
