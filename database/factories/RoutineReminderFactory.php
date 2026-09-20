<?php

namespace Database\Factories;

use App\Enums\ReminderAnchor;
use App\Enums\ReminderChannel;
use App\Models\Routine;
use App\Models\RoutineReminder;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<RoutineReminder>
 */
class RoutineReminderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $anchor = fake()->randomElement(ReminderAnchor::cases());

        return [
            'routine_id' => Routine::factory(),
            'anchor' => $anchor,
            'offset_minutes' => $anchor->defaultOffsetMinutes(),
            'channel' => ReminderChannel::Database,
            'is_active' => true,
        ];
    }

    public function anchoredAt(ReminderAnchor $anchor, ?int $offsetMinutes = null): static
    {
        return $this->state(fn (array $attributes) => [
            'anchor' => $anchor,
            'offset_minutes' => $offsetMinutes ?? $anchor->defaultOffsetMinutes(),
        ]);
    }

    public function forRoutine(Routine $routine): static
    {
        return $this->state(fn (array $attributes) => [
            'routine_id' => $routine->id,
        ]);
    }
}
