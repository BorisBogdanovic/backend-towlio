<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SendMessageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation()
    {
        if ($this->message) {
            $this->merge([
                'message' => trim($this->message),
            ]);
        }
    }

    public function rules(): array
    {
        return [
            'to_id' => ['required', 'exists:users,id'],

            'type' => ['required', 'in:text,image,file'],

            'message' => [
                'required_if:type,text',
                'string',
                'min:1',
            ],

            'file' => [
                'required_unless:type,text',
                'file',
                'max:10240', // 10MB
            ],
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $type = $this->type;
            $file = $this->file('file');

            // 🔴 zabrana slanja samom sebi
            if ($this->to_id == auth()->id()) {
                $validator->errors()->add('to_id', 'You cannot send message to yourself.');
            }

            // 🔴 dodatna validacija za file tipove
            if ($file) {
                if ($type === 'image') {
                    if (!in_array($file->extension(), ['jpg', 'jpeg', 'png', 'webp'])) {
                        $validator->errors()->add('file', 'Only JPG, PNG, and WebP images are allowed.');
                    }
                }

                if ($type === 'file') {
                    if (!in_array($file->extension(), ['pdf'])) {
                        $validator->errors()->add('file', 'Only PDF files are allowed.');
                    }
                }
            }

            // 🔴 zabrani message + file zajedno
            if ($type !== 'text' && $this->message) {
                $validator->errors()->add('message', 'Message is not allowed for file or image.');
            }
        });
    }

    public function messages(): array
    {
        return [
            'to_id.required' => 'Recipient is required.',
            'to_id.exists' => 'Recipient not found.',
            'type.required' => 'Message type is required.',
            'type.in' => 'Invalid message type.',
            'message.required_if' => 'Message is required for text messages.',
            'file.required_unless' => 'File is required for this message type.',
        ];
    }
}