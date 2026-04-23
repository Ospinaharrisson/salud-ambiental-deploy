<?php

use App\Http\Controllers\Admin\Home\UserMessageController;

Route::controller(UserMessageController::class)->group(function () {
    Route::get('message', 'messageHomeView')->name('message');
    Route::get('message/{id}', 'showMessage')->name('message.show');
    Route::delete('message/{id}', 'destroyMessage')->name('message.destroy');
});

