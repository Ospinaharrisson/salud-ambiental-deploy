<?php

use App\Http\Controllers\Admin\Home\FooterItemController;

Route::controller(FooterItemController::class)->group(function () {
    Route::get('footer', 'footerHomeView')->name('footer');
    Route::get('footer/{category}/create', 'footerCreateView')->name('footer.create');
    Route::get('footer/{category}/{id}/edit', 'footerUpdateView')->name('footer.edit');

    Route::post('footer', 'storeFooterItem')->name('footer.store');
    Route::patch('footer/{category}/{id}/update', 'updateFooterItem')->name('footer.update');
    Route::patch('footer/{category}/{id}/toggle', 'toggleFooterItem')->name('footer.toggle');
    Route::post('footer/sort', 'sortFooterItem')->name('footer.sort');
});
