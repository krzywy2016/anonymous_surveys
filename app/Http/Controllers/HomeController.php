<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\SurveyInterface;
use App\Interfaces\QuestionInterface;
use Auth;

class HomeController extends Controller
{
    protected $surveyService;
    protected $questionService;

    public function __construct(SurveyInterface $surveyService, QuestionInterface $questionService)
    {
        $this->surveyService = $surveyService;
        $this->questionService = $questionService;
    }

    public function index()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        } else {
            return view('welcome');
        }
    }

    public function dashboard()
    {
        return view('admin.index');
    }

    public function editSurvey(int $id)
    {
        $survey = $this->surveyService->getSurvey($id);
        $questions = $this->questionService->getQuestions($id);
        return view('admin.create_questions', compact('survey', 'questions'));
    }

    public function showSurvey($id)
    {
        $survey = $this->surveyService->getSurvey($id);
        $questions = $this->questionService->getQuestions($id);
        return view('survey.index', compact('survey', 'questions'));
    }
}
