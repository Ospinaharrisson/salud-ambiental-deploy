<?php

use App\Http\Controllers\Admin\Home\CalendarEventController;

Route::controller(CalendarEventController::class)->group(function () {
    Route::get('calendar', 'calendarHomeView')->name('calendar');
    Route::get('calendar/{id}/edit', 'calendarUpdateView')->name('calendar.edit');

    Route::post('calendar', 'storeCalendarEvent')->name('calendar.store');
    Route::patch('calendar/{id}/update', 'updateCalendarEvent')->name('calendar.update');
    Route::patch('calendar/{id}/toggle','toggleCalendarEvent')->name('calendar.toggle');
    Route::delete('calendar/{id}', 'destroyCalendarEvent')->name('calendar.destroy');
});
