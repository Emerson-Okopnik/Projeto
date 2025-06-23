<?php

namespace Database\Factories;

use App\Models\Appointment;
use App\Models\Pet;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class MedicalRecordFactory extends Factory
{
    protected $model = \App\Models\MedicalRecord::class;

    public function definition(): array
    {
        return [
            'appointment_id' => Appointment::factory(),
            'pet_id' => Pet::factory(),
            'veterinarian_id' => User::factory()->veterinarian(),
            'diagnosis' => $this->faker->sentence(),
            'treatment' => $this->faker->paragraph(),
            'prescription' => $this->faker->sentence(),
            'observations' => $this->faker->optional()->sentence(),
            'symptoms' => $this->faker->optional()->sentence(),
            'vital_signs' => [
                'heart_rate' => $this->faker->numberBetween(60, 120),
                'respiratory_rate' => $this->faker->numberBetween(10, 30),
            ],
            'weight' => $this->faker->randomFloat(2, 1, 60),
            'temperature' => $this->faker->randomFloat(1, 36, 40),
        ];
    }
}
