<?php

namespace App\Services;

use App\Models\Survey;
use App\Interfaces\SurveyInterface;
use Auth;
use Illuminate\Support\Str;

class SurveyService implements SurveyInterface
{
    public function getSurvey()
    {
        return Survey::all();
    }
    
    public function createSurvey(array $data)
    {
        $user = Auth::user();
        $slug = Str::random(10); // tymczasowa plomba

        $survey = Survey::create([
            'title' => $data['surveyTitle'],
            'description' => $data['surveyDescription'],
            'user_id' => 1,//$user->id, plomba bo chwilowo nie działa autoryzacja
            'slug' => $slug,
            'url_to_share' => $slug, // tu trzeba będzie poprawić routing i dać default null
        ]);

        return $survey; // Jeśli chcesz zwrócić stworzoną ankietę, możesz to zrobić
    }
}