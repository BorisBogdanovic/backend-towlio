<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePasswordRequest extends FormRequest
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
        return   [
            'password' => [
            'required',
            'string',
            'min:8',
            'confirmed',
            'regex:/[a-z]/',      
            'regex:/[A-Z]/',      
            'regex:/[0-9]/',      
            'regex:/[@$!%*#?&]/' 
        ],
             'current_password' => 'required|current_password',
        ];
    }
    public function messages(): array
    {
        return [
           'current_password.required' => 'You must enter your current password.',
            'current_password.current_password' => 'The current password is incorrect.',

            'password.required' => 'Please enter a new password.',
            'password.string' => 'Password must be a valid string.',
            'password.min' => 'Password must be at least 8 characters.',
            'password.confirmed' => 'Passwords do not match.',
            'password.regex' => 'Password must include at least one uppercase letter, one lowercase letter, one number, and one special character (@$!%*#?&).',
        ];
    }
}
 