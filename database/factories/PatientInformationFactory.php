<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PatientInformation>
 */
class PatientInformationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'address' => $this->faker->address(),
            'contact_number' => $this->faker->phoneNumber(),
            'age' => $this->faker->numberBetween(1, 100),
            'sex' => $this->faker->randomElement(['Male', 'Female', 'Other']),

            // Prescription structure
            'prescription' => [
                'far' => [
                    'od' => [
                        'sphere' => $this->faker->randomElement(['-1.00', '-0.75', '-1.25', '0.00']),
                        'cylinder' => $this->faker->randomElement(['-0.25', '-0.50', '-1.00']),
                        'axis' => $this->faker->numberBetween(0, 180),
                        'monopd' => $this->faker->numberBetween(28, 32),
                    ],
                    'os' => [
                        'sphere' => $this->faker->randomElement(['-1.00', '-0.75', '-1.25', '0.00']),
                        'cylinder' => $this->faker->randomElement(['-0.25', '-0.50', '-1.00']),
                        'axis' => $this->faker->numberBetween(0, 180),
                        'monopd' => $this->faker->numberBetween(28, 32),
                    ],
                ],
                'near' => [
                    'od' => [
                        'sphere' => $this->faker->randomElement(['+1.00', '+1.25', '+1.50']),
                        'cylinder' => $this->faker->randomElement(['0.00', '-0.25']),
                        'axis' => $this->faker->numberBetween(0, 180),
                        'monopd' => $this->faker->numberBetween(28, 32),
                    ],
                    'os' => [
                        'sphere' => $this->faker->randomElement(['+1.00', '+1.25', '+1.50']),
                        'cylinder' => $this->faker->randomElement(['0.00', '-0.25']),
                        'axis' => $this->faker->numberBetween(0, 180),
                        'monopd' => $this->faker->numberBetween(28, 32),
                    ],
                ],
            ],

            'frame_type' => $this->faker->randomElement(['Full Rim', 'Half Rim', 'Rimless']),
            'color' => $this->faker->safeColorName(),
            'lens_supply' => $this->faker->randomElement(['Single Vision', 'Bifocal', 'Progressive']),
            'diagnosis' => $this->faker->randomElement(['Myopia', 'Hyperopia', 'Astigmatism', 'Presbyopia']),

            'amount' => $this->faker->randomFloat(2, 1000, 5000),
            'deposit' => $this->faker->randomFloat(2, 200, 1000),
            'balance' => $this->faker->randomFloat(2, 0, 4000),

            'special_instructions' => $this->faker->sentence(),
            'follow_up_on' => $this->faker->dateTimeBetween('now', '+2 months'),
        ];
    }
}
