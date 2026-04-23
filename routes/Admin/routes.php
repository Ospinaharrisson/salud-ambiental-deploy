<?php
use App\Http\Controllers\Admin\AdminController;

Route::controller(AdminController::class)->group(function () {
    Route::get('/login', 'login')->name('login');
    Route::post('/authenticate', 'authenticate')->name('authenticate');

    // Route::middleware('auth')->group(function () {
        Route::post('/logout', 'logout')->name('logout');
        Route::get('/admin', 'adminIndexView')->name('admin.index');
        Route::get('/admin/home', 'homeModuleView')->name('admin.home');
        Route::get('/admin/themes/{module}', 'themesModuleView')->name('admin.themes');
    // });
});
