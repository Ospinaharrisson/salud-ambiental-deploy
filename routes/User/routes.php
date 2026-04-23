<?php

use App\Http\Controllers\User\HomeController;

Route::get('/', function() {
    return redirect('/Home');
});

Route::get('/Home', [HomeController::class, 'home'])->name('home');
Route::post('/contact', [HomeController::class, 'createMessage'])->name('home.contact.create')->middleware('throttle:3,1');
