<?php

namespace Database\Factories;

use App\Enums\DayPart;
use App\Models\Group;
use App\Models\Project;
use App\Models\Routine;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Task>
 */
class TaskFactory extends Factory
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
            'created_by_user_id' => fn (array $attributes) => $attributes['user_id'],
            'group_id' => null,
            'project_id' => null,
            'routine_id' => null,
            'title' => rtrim(fake()->sentence(4), '.'),
            'notes' => fake()->optional()->sentence(),
            'day_part' => fake()->randomElement(DayPart::cases()),
            'scheduled_for' => today(),
            'scheduled_at' => null,
            'estimated_minutes' => fake()->randomElement([5, 10, 15, 30, 45]),
            'position' => fake()->numberBetween(0, 10),
            'is_ai_suggested' => false,
            'completed_at' => null,
            'skipped_at' => null,
            'snoozed_until' => null,
        ];
    }

    public function forUser(User $user): static
    {
        return $this->state(fn (array $attributes) => [
            'user_id' => $user->id,
            'created_by_user_id' => $user->id,
        ]);
    }

    /**
     * Tâche confiée à un membre du groupe par quelqu'un d'autre.
     */
    public function assignedBy(User $creator): static
    {
        return $this->state(fn (array $attributes) => [
            'created_by_user_id' => $creator->id,
        ]);
    }

    public function forGroup(Group $group): static
    {
        return $this->state(fn (array $attributes) => [
            'group_id' => $group->id,
        ]);
    }

    /**
     * Étape d'un projet : pas de date imposée tant qu'elle n'est pas planifiée.
     */
    public function forProject(Project $project): static
    {
        return $this->state(fn (array $attributes) => [
            'project_id' => $project->id,
            'user_id' => $project->user_id,
            'created_by_user_id' => $project->user_id,
            'group_id' => $project->group_id,
            'scheduled_for' => null,
            'day_part' => null,
        ]);
    }

    /**
     * Occurrence générée par une routine, pour la date donnée.
     */
    public function fromRoutine(Routine $routine, ?string $scheduledFor = null): static
    {
        return $this->state(fn (array $attributes) => [
            'routine_id' => $routine->id,
            'user_id' => $routine->user_id,
            'created_by_user_id' => $routine->user_id,
            'group_id' => $routine->group_id,
            'title' => $routine->name,
            'day_part' => $routine->day_part,
            'scheduled_for' => $scheduledFor ?? today()->toDateString(),
        ]);
    }

    public function completed(): static
    {
        return $this->state(fn (array $attributes) => [
            'completed_at' => now()->subHours(fake()->numberBetween(1, 48)),
        ]);
    }

    public function aiSuggested(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_ai_suggested' => true,
        ]);
    }

    /**
     * Tâche remise à plus tard, sans jugement : seule la date change.
     */
    public function snoozed(): static
    {
        return $this->state(fn (array $attributes) => [
            'snoozed_until' => now()->addHours(3),
        ]);
    }
}
