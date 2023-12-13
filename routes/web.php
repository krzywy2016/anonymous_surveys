<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SurveyController;
use App\Http\Controllers\UserController;


Route::get('/', [HomeController::class, 'index'])->name('index')->middleware('auth');

Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard')->middleware('auth');
Route::get('/edit-survey/{id}', [HomeController::class, 'editSurvey'])->name('editSurvey')->middleware('auth');

Route::get('/show-survey', [HomeController::class, 'showSurvey'])->name('showSurvey');


// Załączenie routingów autentykacji
require __DIR__.'/auth.php';