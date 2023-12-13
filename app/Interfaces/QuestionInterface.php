<?php

namespace App\Interfaces;

interface QuestionInterface
{
    public function createQuestion($id);
    public function getQuestions($id);
}