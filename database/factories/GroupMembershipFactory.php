<?php

namespace Database\Factories;

use App\Models\Group;
use App\Models\GroupMembership;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<GroupMembership>
 */
class GroupMembershipFactory extends Factory
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
            'user_id' => User::factory(),
            'display_name' => fake()->firstName(),
            'joined_at' => fake()->dateTimeBetween('-1 year'),
        ];
    }

    public function forMember(Group $group, User $user, ?string $displayName = null): static
    {
        return $this->state(fn (array $attributes) => [
            'group_id' => $group->id,
            'user_id' => $user->id,
            'display_name' => $displayName ?? $user->name,
        ]);
    }

    /**
     * Membre sans surnom : l'affichage retombe sur le nom du compte.
     */
    public function withoutDisplayName(): static
    {
        return $this->state(fn (array $attributes) => [
            'display_name' => null,
        ]);
    }
}
