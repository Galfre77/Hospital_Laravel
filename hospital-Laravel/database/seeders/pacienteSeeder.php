<?php

namespace Database\Seeders;

use App\Models\paciente;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class pacienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        paciente::factory()->count(10)->create();
    }
}
