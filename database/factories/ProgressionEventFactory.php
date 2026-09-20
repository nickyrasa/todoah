<?php

namespace Database\Factories;

use App\Enums\ProgressionEventType;
use App\Models\ProgressionEvent;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;

/**
 * @extends Factory<ProgressionEvent>
 */
class ProgressionEventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $type = fake()->randomElement(ProgressionEventType::cases());

        return [
            'user_id' => User::factory(),
            'type' => $type,
            'xp_awarded' => $type->defaultXpAward(),
            'label_key' => $type->defaultLabelKey(),
            'label_params' => [],
            'subject_type' => null,
            'subject_id' => null,
            'occurred_at' => fake()->dateTimeBetween('-1 month'),
        ];
    }

    /**
     * @param  array<string, mixed>  $labelParams
     */
    public function ofType(ProgressionEventType $type, array $labelParams = []): static
    {
        return $this->state(fn (array $attributes) => [
            'type' => $type,
            'xp_awarded' => $type->defaultXpAward(),
            'label_key' => $type->defaultLabelKey(),
            'label_params' => $labelParams,
        ]);
    }

    /**
     * Rattache l'événement à l'élément qui l'a déclenché.
     */
    public function about(Model $subject): static
    {
        return $this->state(fn (array $attributes) => [
            'subject_type' => $subject->getMorphClass(),
            'subject_id' => $subject->getKey(),
        ]);
    }
}
