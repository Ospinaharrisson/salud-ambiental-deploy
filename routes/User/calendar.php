<?php

use App\Http\Controllers\Shared\CalendarDataController;

Route::get('/calendar/events', [CalendarDataController::class, 'getEvents'])->name('calendar.events');