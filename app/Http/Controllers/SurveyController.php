<?php

namespace App\Http\Controllers;

use App\Interfaces\SurveyInterface;
use App\Http\Requests\StoreSurveyRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SurveyController extends Controller
{
    protected $surveyService;

    public function __construct(SurveyInterface $surveyService)
    {
        $this->surveyService = $surveyService;
    }

    public function get()
    {
        return $this->surveyService->getSurveyList();
    }

    public function create(Request $request) /* StoreSurveyRequest */
    {
        //$validated = $request->validated(); - coś jest zwalone z validacją do sprawdzenia
        $data = $request->all();
        $this->surveyService->createSurvey($data['data']);

        return response()->json(['message' => 'Ankieta została utworzona pomyślnie'], 201);
    }

    public function delete(int $id)
    {
        $this->surveyService->deleteSurvey($id);

        return response()->json(['message' => 'Ankieta została usunięta pomyślnie'], 201);
    }
}
