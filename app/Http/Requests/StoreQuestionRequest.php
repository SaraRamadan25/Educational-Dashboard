<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreQuestionRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'subject_id' => 'required|exists:subjects,id',
            'question' => 'required|string',
            'answers' => 'required|array',
            'is_correct' => 'required|numeric',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            '*.required' => ':attribute is required',
            '*.string' => ':attribute must be a string',
            '*.array' => ':attribute must be an array',
            '*.numeric' => ':attribute must be a numeric value',
            '*.exists' => 'The selected :attribute is invalid',
        ];
    }
}
