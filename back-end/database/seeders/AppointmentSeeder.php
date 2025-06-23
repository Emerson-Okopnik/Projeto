<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Appointment;
use App\Models\Pet;
use App\Models\User;

class AppointmentSeeder extends Seeder
{
    public function run(): void
    {
        $vets = User::where('role', 'veterinarian')->pluck('id');
        if ($vets->isEmpty()) {
            $vets = User::factory()->veterinarian()->count(2)->create()->pluck('id');
        }

        foreach (Pet::all() as $pet) {
            Appointment::factory(rand(1,2))->create([
                'pet_id' => $pet->id,
                'veterinarian_id' => $vets->random(),
            ]);
        }
    }
}