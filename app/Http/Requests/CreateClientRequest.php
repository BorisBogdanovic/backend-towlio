<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\ValidCarModelForBrand;


class CreateClientRequest extends FormRequest
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
            'client_name' => 'required|string|max:50',
            'client_last_name' => 'required|string|max:50',
            'address' => 'required|string|max:255',
            'email' => 'required|email|unique:clients,email',
            'car_brand_id'=> 'required|exists:car_brands,id',
            'car_model_id' => [
            'required',
            'exists:car_models,id',
            new ValidCarModelForBrand($this->input('car_brand_id'))],
            'production_year'=> 'required|integer|min:1900|max:' . date('Y'),
            'licence_plate' => 'required|string|max:50|unique:clients,licence_plate',
            'vin' => ['required', 'string', 'size:17', 'unique:clients,vin', 'regex:/^[A-HJ-NPR-Z0-9]{17}$/'],
            'start_date' => 'sometimes|date',
            'expired_date' => 'sometimes|date|after_or_equal:start_date',
            'status' => 'boolean',
            'towlio_service_id' => 'required|exists:services,id',
            'sales_person_id' => 'nullable|exists:users,id',
            'city' => 'required|string|max:50',
            'country' => 'required|string|max:50',
            'phone' => ['required', 'string', 'regex:/^\+?[0-9\-\s]{6,20}$/'],
        ];
    }
    public function messages(): array
    {
        return [
        'client_name.required' => 'Client first name is required.',
        'client_name.string' => 'Client first name must be a valid text.',
        'client_name.max' => 'Client first name may not be greater than 255 characters.',

        'client_last_name.required' => 'Client last name is required.',
        'client_last_name.string' => 'Client last name must be a valid text.',
        'client_last_name.max' => 'Client last name may not be greater than 255 characters.',

        'address.string' => 'Address must be a valid text.',
        'address.max' => 'Address may not be greater than 255 characters.',

        'email.required' => 'Email is required.',
        'email.email' => 'Please enter a valid email address.',
        'email.unique' => 'This email address is already registered.',

        'car_brand_id.required' => 'Car brand selection is required.',
        'car_brand_id.exists' => 'The selected car brand does not exist.',

        'car_model_id.required' => 'Car model selection is required.',
        'car_model_id.exists' => 'The selected car model does not exist.',

        'production_year.integer' => 'Production year must be a valid number.',
        'production_year.min' => 'Production year cannot be earlier than 1900.',
        'production_year.max' => 'Production year cannot be later than the current year.',

        'licence_plate.required' => 'Licence plate is required.',
        'licence_plate.string' => 'Licence plate must be a valid text.',
        'licence_plate.max' => 'Licence plate may not be greater than 50 characters.',
        'licence_plate.unique' => 'This licence plate is already registered.',

        'vin.required' => 'VIN number is required.',
        'vin.string' => 'VIN number must be a valid text.',
        'vin.size' => 'VIN number must be exactly 17 characters long.',
        'vin.unique' => 'This VIN number is already registered.',
        'vin.regex' => 'VIN number contains invalid characters.',

        'start_date.date' => 'Start date must be a valid date.',
        'expired_date.date' => 'Expiration date must be a valid date.',
        'expired_date.after_or_equal' => 'Expiration date must be equal to or later than the start date.',

        'status.boolean' => 'Status must be true or false.',

        'towlio_service_id.required' => 'Towlio service selection is required.',
        'towlio_service_id.exists' => 'The selected service does not exist.',

        'sales_person_id.exists' => 'The selected salesperson does not exist.',
        'city.string' => 'City must be a valid text.',
        
        'city.max' => 'City may not be greater than 255 characters.',

        'country.string' => 'Country must be a valid text.',
        'country.max' => 'Country may not be greater than 255 characters.',

        'phone.required' => 'Phone number is required.',
        'phone.string' => 'Phone number must be a string.',
        'phone.regex' => 'Phone number must be valid (can start with +, 6-20 digits).',

        
    ];
    }
}
