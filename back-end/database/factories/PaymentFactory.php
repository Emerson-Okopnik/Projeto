<?php

namespace Database\Factories;

use App\Models\Appointment;
use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentFactory extends Factory
{
    protected $model = \App\Models\Payment::class;

    public function definition(): array
    {
        return [
            'appointment_id' => Appointment::factory(),
            'client_id' => Client::factory(),
            'amount' => $this->faker->randomFloat(2, 50, 300),
            'payment_method' => $this->faker->randomElement(['cash','card','pix','transfer']),
            'status' => $this->faker->randomElement(['pending','paid','cancelled']),
            'paid_at' => $this->faker->optional()->dateTime(),
            'notes' => $this->faker->optional()->sentence(),
        ];
    }
}