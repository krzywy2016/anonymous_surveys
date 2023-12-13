<?php

namespace App\Services;

use App\Models\Question;
use App\Interfaces\QuestionInterface;
use Auth;
use Illuminate\Support\Str;

class QuestionService implements QuestionInterface
{
    /// do przeanalizowania jeszcze funkcje
    public function getQuestion()
    {
        return Question::all();
    }
    
    public function createSurvey(array $data)
    {
        $user = Auth::user();
        $slug = Str::random(10); // tymczasowa plomba

        $Question = Question::create([
            'title' => $data['surveyTitle'],
            'description' => $data['surveyDescription'],
            'user_id' => 1,//$user->id, plomba bo chwilowo nie działa autoryzacja
            'slug' => $slug,
            'url_to_share' => $slug, // tu trzeba będzie poprawić routing i dać default null
        ]);

        return $Question; 
    }
}