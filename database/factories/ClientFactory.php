<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Service; 
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
        return [
            'client_name' => $this->faker->firstName(),
            'client_last_name' => $this->faker->lastName(),
            'address' => $this->faker->address(),
            'email' => $this->faker->unique()->safeEmail(),
            'car_brand' => $this->faker->randomElement(['Toyota', 'BMW', 'Audi', 'Mercedes']),
            'car_model' => $this->faker->word(),
            'licence_plate' => strtoupper($this->faker->bothify('??###??')),
            'vin' => strtoupper($this->faker->unique()->bothify('?????????????????')),
            'start_date' => $this->faker->dateTimeBetween('-1 month', 'now')->format('Y-m-d'),
            'expired_date' => $this->faker->dateTimeBetween('now', '+1 year')->format('Y-m-d'),
            'status' => $this->faker->boolean(90), 
            'towlio_service_id' => Service::inRandomOrder()->first()->id,
            'sales_person_id' => User::inRandomOrder()->first()->id,
        ];
    }
}
