<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SurveyController;
use App\Http\Controllers\QuestionController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/get-survey', [SurveyController::class, 'get'])->name('api.getSurveys');
Route::post('/survey-create', [SurveyController::class, 'create'])->name('api.surveyCreate');

Route::post('/question-create', [QuestionController::class, 'createQuestion'])->name('api.createQuestion');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

