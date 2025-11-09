<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ForgotPasswordRequest extends FormRequest
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
         return ['email' => ['required', 'email', 'exists:users,email,status_id,1']];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'The email field is required.',
            'email.email' => 'Please enter a valid email address.',
            'email.exists' => 'We couldn’t find an account with that email address.',
        ];
    }

    public function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        $response = response()->json([
            'status' => 'If your email exists in our system, you will receive a reset link shortly.'
        ], 200);

        throw new \Illuminate\Validation\ValidationException($validator, $response);
    }

protected function prepareForValidation(): void
{
    $this->merge([
        'email' => trim($this->email),
    ]);
}
}
