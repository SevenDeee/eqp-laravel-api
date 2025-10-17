<?php

namespace Database\Seeders;

use App\Models\PatientInformation;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // PatientInformation::create([
        //     'name' => 'John Doe',
        //     'address' => '123 Main St',
        //     'contact_number' => '09123456789',
        //     'age' => 35,
        //     'sex' => 'Male',
        //     'prescription' => [
        //         'far' => [
        //             'od' => ['sphere' => '-1.00', 'cylinder' => '-0.50', 'axis' => '90', 'monopd' => '31'],
        //             'os' => ['sphere' => '-0.75', 'cylinder' => '-0.25', 'axis' => '85', 'monopd' => '31'],
        //         ],
        //         'near' => [
        //             'od' => ['sphere' => '+1.00', 'cylinder' => '0.00', 'axis' => '', 'monopd' => '31'],
        //             'os' => ['sphere' => '+1.00', 'cylinder' => '0.00', 'axis' => '', 'monopd' => '31'],
        //         ],
        //     ],
        //     'frame_type' => 'Full Rim',
        //     'color' => 'Black',
        //     'lens_supply' => 'Single Vision',
        //     'diagnosis' => 'Myopia',
        //     'amount' => 3500,
        //     'deposit' => 1000,
        //     'balance' => 2500,
        //     'special_instructions' => 'Handle with care',
        //     'follow_up_on' => now()->addDays(30),
        // ]);

        $this->call([
            PatientInformationSeeder::class,
        ]);
    }
}
