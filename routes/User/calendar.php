<?php

use App\Http\Controllers\Shared\CalendarDataController;

Route::get('/calendar/events', [CalendarDataController::class, 'getEvents'])->name('calendar.events');
Route::get('/calendar/events/{id}', [CalendarDataController::class, 'getUrl'])->name('calendar.event');