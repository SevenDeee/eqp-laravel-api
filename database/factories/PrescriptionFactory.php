<?php

namespace Database\Factories;

use App\Models\Patient;
use App\Models\PatientInformation;
use App\Models\Prescription;
use App\Models\User;
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
        return [
            'patient_id' => Patient::factory(),
            'far' => $this->generateVisionData(),
            'near' => $this->generateVisionData(),
            'remarks' => $this->faker->optional()->sentence(),
            'prescribed_by' => User::factory(),
            'created_at' => $this->faker->dateTimeBetween('-2 years', 'now'),
        ];
    }

    /**
     * Generate realistic vision prescription data.
     */
    private function generateVisionData(): array
    {
        return [
            'od' => [
                'sphere' => $this->faker->randomFloat(2, -10, 5),
                'cylinder' => $this->faker->optional()->randomFloat(2, -4, 0),
                'axis' => $this->faker->optional()->numberBetween(1, 180),
                'monopd' => $this->faker->randomFloat(1, 28, 35),
            ],
            'os' => [
                'sphere' => $this->faker->randomFloat(2, -10, 5),
                'cylinder' => $this->faker->optional()->randomFloat(2, -4, 0),
                'axis' => $this->faker->optional()->numberBetween(1, 180),
                'monopd' => $this->faker->randomFloat(1, 28, 35),
            ],
        ];
    }

    /**
     * Indicate that the prescription is for distance vision only.
     */
    public function distanceOnly(): static
    {
        return $this->state(fn(array $attributes) => [
            'far' => $this->generateVisionData(),
            'near' => null,
        ]);
    }

    /**
     * Indicate that the prescription is for reading vision only.
     */
    public function readingOnly(): static
    {
        return $this->state(fn(array $attributes) => [
            'far' => null,
            'near' => $this->generateVisionData(),
        ]);
    }

    /**
     * Indicate that the prescription includes remarks.
     */
    public function withRemarks(): static
    {
        return $this->state(fn(array $attributes) => [
            'remarks' => $this->faker->sentence(),
        ]);
    }
}
