<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\UserProgression;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<UserProgression>
 */
class UserProgressionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'level' => fake()->numberBetween(1, 6),
            'total_xp' => fake()->numberBetween(0, 1500),
            'momentum_score' => fake()->randomFloat(2, 0, 100),
            'momentum_computed_at' => now(),
            'avatar_variant' => fake()->randomElement(['seed', 'sprout', 'sapling', 'tree']),
        ];
    }

    public function atLevel(int $level, int $totalXp): static
    {
        return $this->state(fn (array $attributes) => [
            'level' => $level,
            'total_xp' => $totalXp,
        ]);
    }
}
