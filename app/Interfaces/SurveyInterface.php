<?php

namespace App\Interfaces;

interface SurveyInterface
{
    public function getSurvey(int $id);
    public function getSurveyList();
    public function createSurvey(array $data);
    public function saveSettings(int $id);
}