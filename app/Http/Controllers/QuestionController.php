<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\QuestionInterface;

class QuestionController extends Controller
{
    protected $questionService;

    public function __construct(QuestionInterface $questionService)
    {
        $this->questionService = $questionService;
    }

    public function createQuestion(Request $request)
    {
        $data = $request->all();
        $this->questionService->saveQuestions($data);

        return response()->json(['message' => 'Pytanie zostało pomyślnie dodane'], 201);
    }
}
