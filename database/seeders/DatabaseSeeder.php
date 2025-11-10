<?php

namespace Database\Seeders;

use App\Models\Patient;
use App\Models\Prescription;
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
        // Create users (doctors/staff)
        $users = User::factory(5)->create();

        // Create a default admin user
        $admin = User::factory()->create([
            'name' => 'Admin User',
        ]);

        // Create patients with prescriptions
        Patient::factory(30)
            ->active()
            ->recycle($users) // Reuse created users
            ->has(
                Prescription::factory()
                    ->count(rand(1, 3))
                    ->recycle($users)
            )
            ->create();

        // Create some patients with follow-ups
        Patient::factory(10)
            ->active()
            ->withFollowUp()
            ->recycle($users)
            ->has(
                Prescription::factory()
                    ->count(rand(1, 2))
                    ->recycle($users)
            )
            ->create();

        // Create some fully paid patients
        Patient::factory(15)
            ->active()
            ->fullyPaid()
            ->recycle($users)
            ->has(
                Prescription::factory()
                    ->count(rand(1, 2))
                    ->recycle($users)
            )
            ->create();

        // Create some archived patients
        Patient::factory(5)
            ->archived()
            ->recycle($users)
            ->has(
                Prescription::factory()
                    ->count(rand(1, 2))
                    ->recycle($users)
            )
            ->create();

        // Create some patients with specific prescription types
        Patient::factory(5)
            ->active()
            ->recycle($users)
            ->has(
                Prescription::factory()
                    ->distanceOnly()
                    ->recycle($users)
            )
            ->create();

        Patient::factory(5)
            ->active()
            ->recycle($users)
            ->has(
                Prescription::factory()
                    ->readingOnly()
                    ->recycle($users)
            )
            ->create();
    }
}
