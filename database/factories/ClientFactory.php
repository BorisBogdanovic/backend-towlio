<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Service; 
use App\Models\CarBrand;
use App\Models\CarModel;
use App\Models\User; 

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
public function definition(): array
{
    $vinChars = 'ABCDEFGHJKLMNPRSTUVWXYZ0123456789';

    
    $brand = CarBrand::whereHas('models')->inRandomOrder()->first();
    $model = $brand->models()->inRandomOrder()->first();

    return [
        'client_name' => $this->faker->firstName(),
        'client_last_name' => $this->faker->lastName(),
        'address' => $this->faker->address(),
        'email' => $this->faker->unique()->safeEmail(),
        'car_brand_id' => $brand->id,
        'car_model_id' => $model->id,
        'licence_plate' => strtoupper($this->faker->bothify('??###??')),
        'vin' => strtoupper($this->faker->unique()->regexify("[$vinChars]{17}")),
        'start_date' => $this->faker->dateTimeBetween('-1 month', 'now')->format('Y-m-d'),
        'expired_date' => $this->faker->dateTimeBetween('now', '+1 year')->format('Y-m-d'),
        'status' => $this->faker->boolean(50), 
        'towlio_service_id' => Service::inRandomOrder()->first()->id,
        'sales_person_id' => User::inRandomOrder()->first()->id,
        'production_year' => $this->faker->numberBetween(1901, date('Y')),
        'city' => $this->faker->city(),
        'country' => $this->faker->country(),
        'phone' => '+381' . $this->faker->regexify('[6-7][0-9]{8}'),
    ];
}

}
