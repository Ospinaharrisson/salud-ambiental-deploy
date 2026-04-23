<?php

use App\Http\Controllers\Admin\Themes\PageAssetController;

Route::controller(PageAssetController::class)->group(function () {
    Route::get('page/{page_id}/categories', 'categoryHomeView')->name('page.categories');
    Route::get('page/{page_id}/categories/create', 'categoryCreateView')->name('page.categories.create');
    Route::get('page/{page_id}/categories/{category_id}/edit', 'categoryUpdateView')->name('page.categories.edit');
    Route::get('page/{page_id}/categories/{category_id}/assets', 'assetHomeView')->name('page.categories.asset');

    Route::post('page/{page_id}/categories', 'storeCategory')->name('page.categories.store');
    Route::patch('page/{page_id}/categories/{category_id}/update', 'updateCategory')->name('page.categories.update');
    Route::patch('page/{page_id}/categories/{category_id}/toggle', 'toggleCategory')->name('page.categories.toggle');
    Route::post('page/{page_id}/categories/sort', 'sortCategories')->name('page.categories.sort');
    Route::delete('page/{page_id}/categories/{category_id}', 'destroyCategory')->name('page.categories.destroy');

    Route::get('page/{page_id}/categories/{category_id}/assets/create', 'assetCreateView')->name('page.categories.asset.create');
    Route::get('page/{page_id}/categories/{category_id}/assets/{asset_id}/edit', 'assetUpdateView')->name('page.categories.asset.edit');
    Route::post('page/{page_id}/categories/{category_id}/assets', 'storeAsset')->name('page.categories.asset.store');
    Route::patch('page/{page_id}/categories/{category_id}/assets/{asset_id}/update', 'updateAsset')->name('page.categories.asset.update');
    Route::patch('page/{page_id}/categories/{category_id}/assets/{asset_id}/toggle', 'toggleAsset')->name('page.categories.asset.toggle');
    Route::post('page/{page_id}/categories/{category_id}/assets/sort', 'sortAssets')->name('page.categories.asset.sort');
    Route::delete('page/{page_id}/categories/{category_id}/assets/{asset_id}', 'destroyAsset')->name('page.categories.asset.destroy');
});