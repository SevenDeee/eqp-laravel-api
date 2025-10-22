<?php

namespace Database\Factories;

use App\Models\PatientInformation;
use App\Models\Prescription;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Prescription>
 */
class PrescriptionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Prescription::class;

    public function definition(): array
    {
        $prescription = [
            'far' => [
                'od' => [
                    'sphere' => $this->faker->randomFloat(2, -5, 5),
                    'cylinder' => $this->faker->randomFloat(2, -3, 3),
                    'axis' => $this->faker->numberBetween(0, 180),
                    'monopd' => $this->faker->numberBetween(55, 70),
                ],
                'os' => [
                    'sphere' => $this->faker->randomFloat(2, -5, 5),
                    'cylinder' => $this->faker->randomFloat(2, -3, 3),
                    'axis' => $this->faker->numberBetween(0, 180),
                    'monopd' => $this->faker->numberBetween(55, 70),
                ],
            ],
            'near' => [
                'od' => [
                    'sphere' => $this->faker->randomFloat(2, -2, 2),
                    'cylinder' => $this->faker->randomFloat(2, -1, 1),
                    'axis' => $this->faker->numberBetween(0, 180),
                    'monopd' => $this->faker->numberBetween(55, 70),
                ],
                'os' => [
                    'sphere' => $this->faker->randomFloat(2, -2, 2),
                    'cylinder' => $this->faker->randomFloat(2, -1, 1),
                    'axis' => $this->faker->numberBetween(0, 180),
                    'monopd' => $this->faker->numberBetween(55, 70),
                ],
            ],
        ];

        return [
            'patient_id' => PatientInformation::factory(),
            'prescription' => $prescription,
            'remarks' => $this->faker->optional()->sentence(),
        ];
    }
}
