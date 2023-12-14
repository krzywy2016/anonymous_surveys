<?php

namespace App\Services;

use App\Models\Question;
use App\Interfaces\QuestionInterface;
use Auth;
use Illuminate\Support\Str;

class QuestionService implements QuestionInterface
{
    public function getQuestions(int $id)
    {
        return Question::where('survey_id', $id)->get();
    }

    public function saveQuestions(array $data)
    {
        $questionsData = $data['questions'];
        $i = 0;

        foreach ($questionsData as $questionData) {
            $i++;
            $question = Question::create([
                'survey_id' => $data['surveyId'],
                'content' => $questionData['text'],
                'type' => $questionData['answerType'],
                'options' => json_encode($questionData['choices']),
                'order' => $i,
            ]);
        }
    }
}