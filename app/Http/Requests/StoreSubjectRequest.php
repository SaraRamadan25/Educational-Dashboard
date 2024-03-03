<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSubjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'semester_id' => 'required|integer|exists:semesters,id',
            ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */

    public function attributes(): array
    {
        return [
            'name' => __('subjects.name'),
            'semester_id' => __('semesters.id'),
        ];
    }}
