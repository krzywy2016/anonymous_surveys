<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SurveyController;
use App\Http\Controllers\UserController;


Route::get('/', function () {
    return view('layouts.dashboard');
});

// Panel administratora
Route::prefix('admin')->group(function () {
    Route::get('/create-survey', [AdminController::class, 'createSurvey'])->name('admin.create-survey');
    Route::post('/store-survey', [AdminController::class, 'storeSurvey'])->name('admin.store-survey');
    // Dodaj inne ścieżki dla edycji, usuwania itp.

    Route::get('/survey-list', [AdminController::class, 'surveyList'])->name('admin.survey-list');
});

// Statystyki ankiet
Route::get('/survey-summary/{survey}', [SurveyController::class, 'surveySummary'])->name('survey.summary');

// Lista ostatnich wypełnionych ankiet
Route::get('/recent-responses', [SurveyController::class, 'recentResponses'])->name('survey.recent-responses');
Route::get('/modify-response/{response}', [SurveyController::class, 'modifyResponse'])->name('survey.modify-response');
Route::post('/update-response/{response}', [SurveyController::class, 'updateResponse'])->name('survey.update-response');
Route::delete('/delete-response/{response}', [SurveyController::class, 'deleteResponse'])->name('survey.delete-response');

// Widok użytkownika
Route::prefix('user')->group(function () {
    Route::get('/open-surveys', [UserController::class, 'openSurveys'])->name('user.open-surveys');
    Route::get('/closed-survey/{survey}', [UserController::class, 'closedSurvey'])->name('user.closed-survey');
});

// Załączenie routingów autentykacji
require __DIR__.'/auth.php';