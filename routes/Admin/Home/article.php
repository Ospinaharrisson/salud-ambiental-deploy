<?php

use App\Http\Controllers\Admin\Home\ArticleController;

Route::controller(ArticleController::class)->group(function () {
    Route::get('article', 'articleHomeView')->name('article');
    Route::get('article/create', 'articleCreateView')->name('article.create');
    Route::get('article/{id}/edit', 'articleUpdateView')->name('article.edit');

    Route::post('article', 'storeArticle')->name('article.store');
    Route::patch('article/{id}/update', 'updateArticle')->name('article.update');
    Route::patch('article/{id}/toggle', 'toggleArticle')->name('article.toggle');
    Route::post('article/sort', 'sortArticle')->name('article.sort');
    Route::delete('article/{id}', 'destroyArticle')->name('article.destroy');
});
