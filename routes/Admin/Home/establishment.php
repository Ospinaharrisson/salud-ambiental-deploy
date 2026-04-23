<?php

use App\Http\Controllers\Admin\Home\EstablishmentButtonController;

Route::controller(EstablishmentButtonController::class)->group(function () {
    Route::get('establishment', 'establishmentHomeView')->name('establishment');
    Route::get('establishment/create', 'establishmentCreateView')->name('establishment.create');
    Route::get('establishment/{id}/edit', 'establishmentUpdateView')->name('establishment.edit');

    Route::post('establishment', 'storeEstablishment')->name('establishment.store');
    Route::patch('establishment/{id}/update', 'updateEstablishment')->name('establishment.update');
    Route::patch('establishment/{id}/toggle','toggleEstablishment')->name('establishment.toggle');
    Route::post('establishment/sort', 'sortEstablishment')->name('establishment.sort');
    Route::delete('establishment/{id}', 'destroyEstablishment')->name('establishment.destroy');
});