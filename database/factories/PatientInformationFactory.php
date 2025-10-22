<?php

namespace Database\Factories;

use App\Models\PatientInformation;
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
    protected $model = PatientInformation::class;

    public function definition(): array
    {
        $sex = $this->faker->randomElement(['Male', 'Female', 'Other']);
        $amount = $this->faker->randomFloat(2, 1000, 10000);
        $deposit = $this->faker->randomFloat(2, 500, $amount);
        $balance = $amount - $deposit;

        return [
            'name' => $this->faker->name($sex === 'Male' ? 'male' : 'female'),
            'address' => $this->faker->address(),
            'contact_number' => $this->faker->phoneNumber(),
            'age' => $this->faker->numberBetween(5, 90),
            'sex' => $sex,

            'frame_type' => $this->faker->randomElement(['Full Rim', 'Half Rim', 'Rimless', 'Clip-On', null]),
            'color' => $this->faker->safeColorName(),
            'lens_supply' => $this->faker->randomElement(['Single Vision', 'Bifocal', 'Progressive', 'Reading Glasses', null]),
            'diagnosis' => $this->faker->sentence(),

            'amount' => $amount,
            'deposit' => $deposit,
            'balance' => $balance,

            'special_instructions' => $this->faker->optional()->sentence(),
            'follow_up_on' => $this->faker->optional()->dateTimeBetween('+1 week', '+3 months'),

            'archived_at' => $this->faker->optional(0.2)->dateTimeBetween('-6 months', 'now'),
        ];
    }
}
