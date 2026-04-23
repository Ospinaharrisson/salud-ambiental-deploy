<?php

use App\Http\Controllers\User\PageRenderController;

Route::controller(PageRenderController::class)->group(function () {
    Route::get('/pagina/{id}/{slug}', 'show')->name('page.show');
    Route::get('/registro/{id}/{slug}', 'showRecords')->name('page.record.show');
    Route::get('/preguntas', 'showQuestions')->name('page.questions.show');
    Route::get('/establecimientos/acreditados', 'showAccredited')->name('page.accredited.show');
    Route::get('/establecimientos/favorables', 'showFavorable')->name('page.favorable.show');
    Route::get('/pagina/{id}', 'showHomePage')->name('page.home.show');
});
