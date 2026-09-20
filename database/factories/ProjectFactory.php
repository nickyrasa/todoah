<?php

namespace Database\Factories;

use App\Models\Group;
use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Project>
 */
class ProjectFactory extends Factory
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
            'group_id' => null,
            'name' => rtrim(fake()->sentence(3), '.'),
            'description' => fake()->optional()->paragraph(),
            'due_on' => fake()->optional()->dateTimeBetween('now', '+3 months'),
            'ai_breakdown_requested_at' => null,
            'ai_breakdown_completed_at' => null,
            'completed_at' => null,
            'position' => fake()->numberBetween(0, 10),
        ];
    }

    public function forUser(User $user): static
    {
        return $this->state(fn (array $attributes) => [
            'user_id' => $user->id,
        ]);
    }

    public function forGroup(Group $group): static
    {
        return $this->state(fn (array $attributes) => [
            'group_id' => $group->id,
        ]);
    }

    public function completed(): static
    {
        return $this->state(fn (array $attributes) => [
            'completed_at' => now()->subDays(fake()->numberBetween(1, 30)),
        ]);
    }

    /**
     * Projet dont le découpage en étapes a été généré par l'IA.
     */
    public function withAiBreakdown(): static
    {
        return $this->state(fn (array $attributes) => [
            'ai_breakdown_requested_at' => now()->subDays(2),
            'ai_breakdown_completed_at' => now()->subDays(2)->addMinutes(3),
        ]);
    }
}
