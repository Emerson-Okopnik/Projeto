<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Payment;
use App\Models\Appointment;

class PaymentSeeder extends Seeder
{
    public function run(): void
    {
        foreach (Appointment::all() as $appointment) {
            Payment::factory()->create([
                'appointment_id' => $appointment->id,
                'client_id' => $appointment->pet->client_id,
            ]);
        }
    }
}