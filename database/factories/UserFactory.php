<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\City;             


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
        'name' => fake()->firstName(),
        'last_name' => fake()->lastName(),
        'email' => fake()->unique()->safeEmail(),
        'password' => Hash::make('password'), 
        'phone' => '+381 6' . fake()->numerify('#######'),
       'status_id' => 1,
        'city_id' => City::inRandomOrder()->first()->id ?? 1,     
        'profile_image_path' => 'images/default-profile.png',
    ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
