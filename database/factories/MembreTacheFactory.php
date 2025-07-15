<?php

namespace Database\Factories;

use App\Models\Membre;
use App\Models\Tache;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MembreTache>
 */
class MembreTacheFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'member_id' => Membre::factory(),
            'task_id' => Tache::factory(),
        ];
    }
}
