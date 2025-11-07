<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchCarModelRequest extends FormRequest
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
            'brand_id' => ['required', 'integer', 'exists:car_brands,id'],
            'q' => ['nullable', 'string', 'max:50'],
        ];
    }
     public function messages(): array
    {
        return [
            'brand_id.required' => 'ID brenda je obavezan parametar.',
            'brand_id.integer' => 'ID brenda mora biti broj.',
            'brand_id.exists' => 'Izabrani brend ne postoji u bazi.',
            'q.string' => 'Parametar pretrage mora biti tekst.',
            'q.max' => 'Parametar pretrage ne sme biti duži od 50 karaktera.',
        ];
    }
}
