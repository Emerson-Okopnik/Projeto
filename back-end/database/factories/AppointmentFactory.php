<?php

namespace Database\Factories;

use App\Models\Pet;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class AppointmentFactory extends Factory
{
    protected $model = \App\Models\Appointment::class;

    public function definition(): array
    {
        return [
            'pet_id' => Pet::factory(),
            'veterinarian_id' => User::factory()->veterinarian(),
            'scheduled_at' => $this->faker->dateTimeBetween('-1 month', '+1 month'),
            'status' => $this->faker->randomElement(['scheduled','in_progress','completed','cancelled']),
            'reason' => $this->faker->sentence(),
            'notes' => $this->faker->optional()->paragraph(),
            'price' => $this->faker->randomFloat(2, 50, 200),
            'duration' => 60,
        ];
    }
}