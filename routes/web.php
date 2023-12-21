<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SurveyController;
use App\Http\Controllers\QuestionController;

Route::get('/', [HomeController::class, 'index'])->name('index');

Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
Route::get('/edit-survey/{id}', [HomeController::class, 'editSurvey'])->name('editSurvey');

Route::get('/show-survey/{id}', [HomeController::class, 'showSurvey'])->name('showSurvey');


// Załączenie routingów autentykacji
require __DIR__.'/auth.php';

// API
Route::get('/get-survey', [SurveyController::class, 'get'])->name('getSurveys');

Route::post('/survey-create', [SurveyController::class, 'create'])->name('surveyCreate');
Route::get('/survey-create', [SurveyController::class, 'aa'])->name('aa');
Route::post('/question-create', [QuestionController::class, 'createQuestion'])->name('createQuestion');


Route::get('get-questions/{id}', [QuestionController::class, 'getQuestions'])->name('getQuestion');

Route::get('/delete-survey/{id}', [SurveyController::class, 'delete'])->name('removeSurvey');
