<?php

namespace Database\Factories;

use App\Enums\MembreRole;
use App\Models\Equipe;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Membre>
 */
class MembreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'email' => fake()->unique()->safeEmail(),
            'role' => fake()->randomElement([
                MembreRole::DEVELOPER->value,
                MembreRole::DESIGNER->value,
                MembreRole::TESTER->value,
            ]),
            'team_id' => Equipe::factory(),
            'joined_at' => fake()->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
