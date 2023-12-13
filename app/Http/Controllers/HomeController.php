<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\SurveyInterface;

class HomeController extends Controller
{
    protected $surveyService;

    public function __construct(SurveyInterface $surveyService)
    {
        $this->surveyService = $surveyService;
    }

    public function dashboard()
    {
        return view('admin.index');
    }

    public function editSurvey()
    {
        return view('admin.create_questions');
    }
}
