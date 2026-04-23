<?php

use App\Http\Controllers\Admin\Themes\ModuleQuestionController;

Route::controller(ModuleQuestionController::class)->group(function () {
    Route::get('questions', 'questionsHomeView')->name('questions');
    Route::get('questions/create', 'createQuestionView')->name('questions.create');
    Route::get('questions/{question_id}/edit', 'editQuestionView')->name('questions.edit');

    Route::post('questions', 'storeQuestion')->name('questions.store');
    Route::patch('questions/{question_id}/update', 'updateQuestion')->name('questions.update');
    Route::patch('questions/{question_id}/toggle', 'toggleQuestion')->name('questions.toggle');
    Route::post('questions/sort', 'sortQuestions')->name('questions.sort');
    Route::delete('questions/{question_id}', 'destroyQuestion')->name('questions.destroy');
});