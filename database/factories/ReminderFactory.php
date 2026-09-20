<?php

namespace Database\Factories;

use App\Enums\ReminderAnchor;
use App\Enums\ReminderChannel;
use App\Models\Reminder;
use App\Models\Task;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Reminder>
 */
class ReminderFactory extends Factory
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
            'task_id' => Task::factory(),
            'anchor' => $anchor,
            'offset_minutes' => $anchor->defaultOffsetMinutes(),
            'channel' => ReminderChannel::Database,
            'scheduled_at' => now()->addHours(fake()->numberBetween(1, 8)),
            'sent_at' => null,
            'dismissed_at' => null,
            'is_active' => true,
        ];
    }

    public function forTask(Task $task): static
    {
        return $this->state(fn (array $attributes) => [
            'task_id' => $task->id,
        ]);
    }

    public function anchoredAt(ReminderAnchor $anchor, ?int $offsetMinutes = null): static
    {
        return $this->state(fn (array $attributes) => [
            'anchor' => $anchor,
            'offset_minutes' => $offsetMinutes ?? $anchor->defaultOffsetMinutes(),
        ]);
    }

    public function sent(): static
    {
        return $this->state(fn (array $attributes) => [
            'scheduled_at' => now()->subHour(),
            'sent_at' => now()->subHour(),
        ]);
    }

    public function dismissed(): static
    {
        return $this->state(fn (array $attributes) => [
            'scheduled_at' => now()->subHours(2),
            'sent_at' => now()->subHours(2),
            'dismissed_at' => now()->subHour(),
        ]);
    }
}
