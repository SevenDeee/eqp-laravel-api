<?php

namespace Database\Seeders;

use App\Models\PatientInformation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PatientInformationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PatientInformation::factory()->count(20)->create();
    }
}
