<?php

namespace App\Services;

use App\Models\Survey;
use App\Interfaces\SurveyInterface;

class SurveyService implements SurveyInterface
{
    public function getSurvey()
    {
        return Survey::all();
    }
    
    public function createSurvey(array $data)
    {
        // Logika tworzenia artykułu...
    }

    public function updateArticle(Article $article, array $data)
    {
        // Logika modyfikowania artykułu...
    }

    public function deleteArticle(Article $article)
    {
        // Logika usuwania artykułu...
    }
}