<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Client;
use App\Models\Pet;

class PetSeeder extends Seeder
{
    public function run(): void
    {
        foreach (Client::all() as $client) {
            Pet::factory(rand(1, 3))->create(['client_id' => $client->id]);
        }
    }
}