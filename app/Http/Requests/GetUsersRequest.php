<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GetUsersRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->hasRole('admin');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
         return [
            'status' => ['sometimes','nullable', 'integer', 'exists:statuses,id'],
            'city' => ['sometimes','nullable', 'integer', 'exists:cities,id'],
            'search' => ['sometimes','nullable', 'string', 'max:50'],
        ];
    }
    public function messages(): array
    {
        return [
            'status.integer' => 'The status must be an integer.',
            'status.exists' => 'The selected status is invalid.',
            
            'city.integer' => 'The city must be an integer.',
            'city.exists' => 'The selected city is invalid.',
            
            'search.string' => 'The search field must be a string.',
            'search.max' => 'The search field may not be greater than 50 characters.',
        ];
    }
}
