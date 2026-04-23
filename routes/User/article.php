<?php

use App\Http\Controllers\User\ArticleRenderController;

Route::controller(ArticleRenderController::class)->group(function() {
    Route::get('/noticias', 'index')->name('articles.index');
    Route::get('/noticias/{id}', 'show')->name('articles.show');
});
