<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\SurveyInterface;
use Auth;

class HomeController extends Controller
{
    protected $surveyService;

    public function __construct(SurveyInterface $surveyService)
    {
        $this->surveyService = $surveyService;
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
        return view('admin.create_questions', compact('survey'));
    }

    public function showSurvey()
    {
        return view('survey.index');
    }
}
