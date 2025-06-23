<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Client;

class PetFactory extends Factory
{
    protected $model = \App\Models\Pet::class;

    public function definition(): array
    {
        return [
            'client_id' => Client::factory(),
            'name' => $this->faker->firstName(),
            'species' => $this->faker->randomElement(['dog', 'cat']),
            'breed' => $this->faker->word(),
            'gender' => $this->faker->randomElement(['male', 'female']),
            'birth_date' => $this->faker->date(),
            'weight' => $this->faker->randomFloat(2, 1, 40),
            'color' => $this->faker->safeColorName(),
            'microchip' => $this->faker->numerify('########'),
            'notes' => $this->faker->sentence(),
        ];
    }
}
