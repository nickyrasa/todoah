<?php

namespace Database\Factories;

use App\Enums\DayPart;
use App\Enums\RoutineFrequency;
use App\Models\Group;
use App\Models\Routine;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Routine>
 */
class RoutineFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $dayPart = fake()->randomElement(DayPart::cases());

        return [
            'user_id' => User::factory(),
            'group_id' => null,
            'name' => rtrim(fake()->sentence(3), '.'),
            'day_part' => $dayPart,
            'frequency' => RoutineFrequency::Daily,
            'interval' => 1,
            'weekdays' => null,
            'day_of_month' => null,
            'starts_on' => today()->subWeeks(fake()->numberBetween(0, 8)),
            'ends_on' => null,
            'suggested_time' => $dayPart->defaultSuggestedTime(),
            'is_active' => true,
            'last_materialized_on' => null,
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

    /**
     * @param  array<int, int>  $weekdays  Jours ISO-8601, de 1 (lundi) à 7 (dimanche).
     */
    public function weekly(array $weekdays): static
    {
        return $this->state(fn (array $attributes) => [
            'frequency' => RoutineFrequency::Weekly,
            'weekdays' => $weekdays,
        ]);
    }

    public function monthly(int $dayOfMonth): static
    {
        return $this->state(fn (array $attributes) => [
            'frequency' => RoutineFrequency::Monthly,
            'day_of_month' => $dayOfMonth,
        ]);
    }

    /**
     * Routine mise en pause : elle ne génère plus de tâche.
     */
    public function paused(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_active' => false,
        ]);
    }
}
