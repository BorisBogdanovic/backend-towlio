<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'email' => ['required', 'email', 'exists:users,email'],
            'password' => ['required','string'],
];
    }

      public function messages(): array
    {
        return [
            'email.required' => 'Please provide your email address.',
            'email.email' => 'The email address must be valid.',
            'email.exists' => 'No account found with this email.',
            'password.required' => 'Please enter your password.',
            'password.string' => 'The password format is invalid.',
        ];
    }

    protected function prepareForValidation()
{
    $this->merge([
        'email' => trim($this->email),
        'password' => trim($this->password),
    ]);
}
}
