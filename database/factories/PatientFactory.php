<?php

namespace Database\Factories;

use App\Models\Patient;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Patient>
 */
class PatientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Patient::class;

    public function definition(): array
    {
        $amount = $this->faker->randomFloat(2, 500, 5000);
        $deposit = $this->faker->randomFloat(2, 0, $amount);
        $balance = $amount - $deposit;

        return [
            'name' => $this->faker->name(),
            'address' => $this->faker->address(),
            'contact_number' => $this->faker->numerify('09#########'),
            'age' => $this->faker->numberBetween(10, 85),
            'sex' => $this->faker->randomElement(['Male', 'Female']),
            'frame_type' => $this->faker->randomElement(['Metal', 'Plastic', 'Rimless', 'Semi-Rimless', null]),
            'color' => $this->faker->optional()->randomElement(['Black', 'Brown', 'Silver', 'Gold', 'Blue', 'Red']),
            'lens_supply' => $this->faker->optional()->randomElement(['Single Vision', 'Bifocal', 'Progressive', 'Photochromic']),
            'diagnosis' => $this->faker->optional()->randomElement(['Myopia', 'Hyperopia', 'Astigmatism', 'Presbyopia', 'Normal']),
            'special_instructions' => $this->faker->optional()->sentence(),
            'follow_up_on' => $this->faker->optional()->dateTimeBetween('now', '+3 months'),
            'amount' => $amount,
            'deposit' => $deposit,
            'balance' => $balance,
            'created_by' => User::factory(),
            'archived_at' => $this->faker->optional(0.1)->dateTimeBetween('-1 year', 'now'),
            'created_at' => $this->faker->dateTimeBetween('-2 years', 'now'),
        ];
    }

    /**
     * Indicate that the patient is archived.
     */
    public function archived(): static
    {
        return $this->state(fn(array $attributes) => [
            'archived_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ]);
    }

    /**
     * Indicate that the patient is active (not archived).
     */
    public function active(): static
    {
        return $this->state(fn(array $attributes) => [
            'archived_at' => null,
        ]);
    }

    /**
     * Indicate that the patient has a follow-up appointment.
     */
    public function withFollowUp(): static
    {
        return $this->state(fn(array $attributes) => [
            'follow_up_on' => $this->faker->dateTimeBetween('now', '+3 months'),
        ]);
    }

    /**
     * Indicate that the patient has fully paid.
     */
    public function fullyPaid(): static
    {
        return $this->state(function (array $attributes) {
            $amount = $attributes['amount'] ?? $this->faker->randomFloat(2, 500, 5000);
            return [
                'amount' => $amount,
                'deposit' => $amount,
                'balance' => 0,
            ];
        });
    }
}
