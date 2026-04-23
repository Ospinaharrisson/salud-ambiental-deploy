<?php

use App\Http\Controllers\Admin\Themes\RecordsPageController;
use App\Http\Controllers\Admin\Themes\RecordItemController;

Route::controller(RecordsPageController::class)->group(function() {
    Route::get('records', 'recordsHomeView')->name('record');
    Route::get('records/create', 'recordsCreateView')->name('record.create');
    Route::get('records/{page_id}/edit', 'recordsEditView')->name('record.edit');
    
    Route::post('records/store', 'storeRecord')->name('record.store');
    Route::patch('records/{page_id}/update', 'updateRecord')->name('record.update');
    Route::patch('records/{page_id}/toggle', 'toggleRecord')->name('record.toggle');
    Route::delete('records/{page_id}', 'destroyRecord')->name('record.destroy');
});

Route::controller(RecordItemController::class)->group(function() {
    Route::get('records/{page_id}/table', 'recordTableHomeView')->name('record.item');
    Route::get('records/{page_id}/create', 'recordItemCreateView')->name('record.item.create');
    Route::get('records/{page_id}/{item_id}/edit', 'recordItemEditView')->name('record.item.edit');

    Route::post('records/{page_id}/store/item', 'storeItem')->name('record.item.store.info');
    Route::post('records/{page_id}/store/stamp', 'storeRecordStamp')->name('record.item.store.stamp');
    Route::post('records/{page_id}/store/details', 'storeRecordDetails')->name('record.item.store.detail');
    Route::post('records/{page_id}/store', 'storeRecordItem')->name('record.item.store');

    Route::patch('records/{page_id}/{item_id}/update/stamp', 'updateRecordStamp')->name('record.item.update.stamp');
    Route::patch('records/{page_id}/{item_id}/update/details', 'updateRecordDetails')->name('record.item.update.detail');
    Route::patch('records/{page_id}/{item_id}/update', 'updateRecordItem')->name('record.item.update');
    Route::patch('records/{page_id}/{item_id}/toggle', 'toggleRecordItem')->name('record.item.toggle');
    Route::delete('records/{page_id}/{item_id}', 'destroyRecordItem')->name('record.item.destroy');
});