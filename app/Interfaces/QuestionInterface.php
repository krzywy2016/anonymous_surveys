<?php

namespace App\Interfaces;

interface QuestionInterface
{
    public function getQuestions(int $id);
    public function saveQuestions(array $data);
}