<?php

namespace App\Rules;

use App\Models\CarModel;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidCarModelForBrand implements ValidationRule
{
    protected $brandId;

    public function __construct($brandId)
    {
        $this->brandId = $brandId;
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Proverava da li model pripada marki
        $exists = CarModel::where('id', $value)
            ->where('car_brand_id', $this->brandId)
            ->exists();

        if (! $exists) {
            $fail('The selected car model does not belong to the specified car brand.');
        }
    }
}
