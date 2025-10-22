<?php

namespace Database\Seeders;

use App\Models\PatientInformation;
use App\Models\Prescription;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PrescriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ensure patients exist first
        $patients = PatientInformation::all();

        if ($patients->isEmpty()) {
            $patients = PatientInformation::factory(20)->create();
        }

        // Create prescriptions for each patient
        $patients->each(function ($patient) {
            Prescription::factory()->create(['patient_id' => $patient->id]);
        });
    }
}
