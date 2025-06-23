<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MedicalRecord;
use App\Models\Appointment;

class MedicalRecordSeeder extends Seeder
{
    public function run(): void
    {
        foreach (Appointment::all() as $appointment) {
            MedicalRecord::factory()->create([
                'appointment_id' => $appointment->id,
                'pet_id' => $appointment->pet_id,
                'veterinarian_id' => $appointment->veterinarian_id,
            ]);
        }
    }
}