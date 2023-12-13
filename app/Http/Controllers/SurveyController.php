<?php

namespace App\Http\Controllers;

use App\Interfaces\SurveyInterface;
use App\Http\Requests\StoreSurveyRequest;
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
    
    public function create(/* StoreSurveyRequest */ Request $request)
    {
        //$validated = $request->validated(); - coś jest zwalone z validacją do sprawdzenia
        $data = $request->all();
        $this->surveyService->createSurvey($data['data']);

        // Dodaj kod obsługi po utworzeniu ankiety, np. przekierowanie, odpowiedź JSON itp.
        return response()->json(['message' => 'Ankieta została utworzona pomyślnie'], 201);
    }
}
