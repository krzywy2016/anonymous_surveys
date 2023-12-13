<?php

namespace App\Http\Controllers;

use App\Interfaces\SurveyInterface;
use Illuminate\Http\Request;

class SurveyController extends Controller
{
    protected $surveyService;

    public function __construct(SurveyInterface $surveyService)
    {
        $this->surveyService = $surveyService;
    }

    public function get()
    {
        return $this->surveyService->getSurvey();
    }
    
    public function create(Request $request)
    {
        $this->surveyService->createSurvey($request->all());
    }
}
