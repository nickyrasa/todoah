<?php

namespace Database\Factories;

use App\Enums\GroupActivityType;
use App\Models\Group;
use App\Models\GroupActivity;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;

/**
 * @extends Factory<GroupActivity>
 */
class GroupActivityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $type = fake()->randomElement(GroupActivityType::cases());

        return [
            'group_id' => Group::factory(),
            'actor_id' => User::factory(),
            'type' => $type,
            'label_key' => $type->defaultLabelKey(),
            'label_params' => ['actor' => fake()->firstName()],
            'subject_type' => null,
            'subject_id' => null,
            'occurred_at' => fake()->dateTimeBetween('-1 month'),
        ];
    }

    public function ofType(GroupActivityType $type): static
    {
        return $this->state(fn (array $attributes) => [
            'type' => $type,
            'label_key' => $type->defaultLabelKey(),
        ]);
    }

    /**
     * Rattache l'activité à l'élément qui l'a déclenchée.
     */
    public function about(Model $subject): static
    {
        return $this->state(fn (array $attributes) => [
            'subject_type' => $subject->getMorphClass(),
            'subject_id' => $subject->getKey(),
        ]);
    }
}
