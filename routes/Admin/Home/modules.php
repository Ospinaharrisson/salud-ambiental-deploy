<?php

use App\Http\Controllers\Admin\Home\ModuleController;
use App\Http\Controllers\Admin\Home\DistrictModuleController;

Route::controller(ModuleController::class)->group(function () { 
    Route::get('module', 'moduleHomeView')->name('module'); 
    Route::get('module/create', 'moduleCreateView')->name('module.create'); 
    Route::get('module/{id}/edit', 'moduleUpdateView')->name('module.edit'); 
    Route::post('module', 'storeModule')->name('module.store'); 

    Route::patch('module/{id}/update', 'updateModule')->name('module.update'); 
    Route::patch('module/{id}/toggle', 'toggleModule')->name('module.toggle'); 
    Route::post('module/sort', 'sortModule')->name('module.sort'); 
    Route::delete('module/{id}', 'destroyModule')->name('module.destroy');
}); 

Route::controller(DistrictModuleController::class)->group(function () { 
    Route::get('district', 'districtHomeView')->name('district');
    Route::get('district/create', 'districtCreateView')->name('district.create'); 
    Route::get('district/{id}/edit', 'districtUpdateView')->name('district.edit');

    Route::post('district', 'storeDistrict')->name('district.store'); 
    Route::patch('district/{id}/update', 'updateDistrict')->name('district.update'); 
    Route::patch('district/{id}/toggle', 'toggleDistrict')->name('district.toggle'); 
    Route::post('district/sort', 'sortDistrict')->name('district.sort'); 
    Route::delete('district/{id}', 'destroyDistrict')->name('district.destroy');
});
