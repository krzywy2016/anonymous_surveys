<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSurveyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'surveyTitle' => 'required|string|max:255',
            'surveyDescription' => 'string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'surveyTitle.required' => 'The name field is required.',
            'surveyTitle.string' => 'The name field must be a string.',
            'surveyTitle.max' => 'The name field must not exceed 255 characters.',
            'surveyDescription.string' => 'The password field must be a string.',
            'surveyDescription.max' => 'The name field must not exceed 255 characters.',
        ];
    }
}
