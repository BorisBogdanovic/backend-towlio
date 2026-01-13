<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SendMessageRequest extends FormRequest
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
            'to_id' => 'required|exists:users,id',
            'message' => 'nullable|string',
            'type' => 'required|in:text,image,file,voice',
            'file_path' => 'nullable|string',
            'file_name' => 'nullable|string',
            'file_size' => 'nullable|integer',
            'voice_duration' => 'nullable|integer',
        ];
    }
     public function messages(): array
    {
        return [
            'to_id.required' => 'Recipient is required.',
            'to_id.exists' => 'Recipient not found.',
            'type.required' => 'Message type is required.',
            'type.in' => 'Invalid message type.',
        ];
    }
}
