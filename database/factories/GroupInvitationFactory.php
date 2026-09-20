<?php

namespace Database\Factories;

use App\Models\Group;
use App\Models\GroupInvitation;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<GroupInvitation>
 */
class GroupInvitationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'group_id' => Group::factory(),
            'invited_by_user_id' => User::factory(),
            'email' => fake()->unique()->safeEmail(),
            'token' => (string) Str::uuid(),
            'invited_user_id' => null,
            'accepted_at' => null,
            'declined_at' => null,
            'expires_at' => now()->addWeek(),
        ];
    }

    public function accepted(): static
    {
        return $this->state(fn (array $attributes) => [
            'invited_user_id' => User::factory(),
            'accepted_at' => now()->subDay(),
        ]);
    }

    public function declined(): static
    {
        return $this->state(fn (array $attributes) => [
            'declined_at' => now()->subDay(),
        ]);
    }

    /**
     * Invitation dont la fenêtre de validité est passée.
     */
    public function lapsed(): static
    {
        return $this->state(fn (array $attributes) => [
            'expires_at' => now()->subDays(3),
        ]);
    }
}
