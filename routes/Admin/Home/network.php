<?php

use App\Http\Controllers\Admin\Home\HealthNetworkController;

Route::controller(HealthNetworkController::class)->group(function () {
    Route::get('network', 'networkHomeView')->name('network');
    Route::get('network/create', 'networkCreateView')->name('network.create');
    Route::get('network/{id}/edit', 'networkUpdateView')->name('network.edit');

    Route::post('network', 'storeNetwork')->name('network.store');
    Route::patch('network/{id}/update', 'updateNetwork')->name('network.update');
    Route::patch('network/{id}/toggle', 'toggleNetwork')->name('network.toggle');
    Route::post('network/sort', 'sortNetwork')->name('network.sort');
    Route::delete('network/{id}', 'destroyNetwork')->name('network.destroy');
});
