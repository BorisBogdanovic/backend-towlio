<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InviteUserRequest extends FormRequest
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
            'email' => ['required', 'email', 'unique:users,email'],
            'token' => ['sometimes', 'string'], 
            'last_name' => ['required', 'string', 'max:50'], 
            'name' => ['required', 'string', 'max:50'],      
            'phone' => ['required', 'string', 'regex:/^\+?[0-9\-\s]{6,20}$/'],
        ];
    }

    public function messages(): array
{
    return [
        'email.required' => 'Email is required.',
        'email.email' => 'Please enter a valid email address.',
        'email.unique' => 'This email address is already registered.',

        'token.string' => 'Token must be a string.',

        'last_name.required' => 'Last name is required.',
        'last_name.string' => 'Last name must be a string.',
        'last_name.max' => 'Last name may not be greater than 50 characters.',

        'name.required' => 'First name is required.',
        'name.string' => 'First name must be a string.',
        'name.max' => 'First name may not be greater than 50 characters.',

        'phone.required' => 'Phone number is required.',
        'phone.string' => 'Phone number must be a string.',
        'phone.regex' => 'Phone number must be valid (can start with +, 6-20 digits).',
    ];
}
}
