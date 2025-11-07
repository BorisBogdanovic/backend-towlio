<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchCarBrandRequest extends FormRequest
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
            'q' => 'nullable|string|max:50',
            'limit' => 'nullable|integer|min:1|max:50',
        ];
    }

    public function messages(): array
    {
        return [
            'q.string' => 'Search query must be a valid text.',
            'q.max' => 'Search query may not be longer than 50 characters.',
            'limit.integer' => 'Limit must be a number.',
            'limit.min' => 'Limit must be at least 1.',
            'limit.max' => 'Limit may not exceed 50.',
        ];
    }
}
