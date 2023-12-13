<?php

namespace App\Services;

use App\Models\Question;
use App\Interfaces\QuestionInterface;
use Auth;
use Illuminate\Support\Str;

class QuestionService implements QuestionInterface
{
    /// do przeanalizowania jeszcze funkcje    
    public function createQuestion(array $data)
    {
        $user = Auth::user();
        $slug = Str::random(10); // tymczasowa plomba

        $Question = Question::create([
            'survey_id' => $data['surveyTitle'],
            'section_id' => $data['surveyDescription'],
            'content' => 1,
            'type' => $slug,
            'options' => $slug, 
            'rules' => $slug, 
            'order' => $slug, 
        ]);

        return $Question; 
    }

    public function getQuestions($id)
    {
        return Question::where('survey_id', $id)->get();
    }
}