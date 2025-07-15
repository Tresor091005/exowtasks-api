<?php

namespace Database\Factories;

use App\Enums\TacheStatus;
use App\Models\Membre;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tache>
 */
class TacheFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(4),
            'description' => fake()->paragraph(3),
            'due_date' => fake()->dateTimeBetween('now', '+2 months'),
            'status' => fake()->randomElement([
                TacheStatus::TODO->value,
                TacheStatus::IN_PROGRESS->value,
                TacheStatus::DONE->value,
            ]),
            'created_by' => Membre::factory(),
        ];
    }
}
