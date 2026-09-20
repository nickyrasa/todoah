<?php

namespace App\Models;

use App\Enums\DayPart;
use App\Enums\RoutineFrequency;
use Database\Factories\RoutineFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Modèle de répétition à partir duquel les tâches sont générées.
 *
 * `suggested_time` n'est pas casté : la colonne est un TIME SQL exposé tel quel
 * sous la forme `HH:MM:SS`.
 */
#[Fillable([
    'user_id',
    'group_id',
    'name',
    'day_part',
    'frequency',
    'interval',
    'weekdays',
    'day_of_month',
    'starts_on',
    'ends_on',
    'suggested_time',
    'is_active',
    'last_materialized_on',
])]
class Routine extends Model
{
    /** @use HasFactory<RoutineFactory> */
    use HasFactory;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class);
    }

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }

    public function reminders(): HasMany
    {
        return $this->hasMany(RoutineReminder::class);
    }

    #[Scope]
    protected function active(Builder $query): void
    {
        $query->where('is_active', true);
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'day_part' => DayPart::class,
            'frequency' => RoutineFrequency::class,
            'interval' => 'integer',
            'weekdays' => 'array',
            'day_of_month' => 'integer',
            'starts_on' => 'date',
            'ends_on' => 'date',
            'is_active' => 'boolean',
            'last_materialized_on' => 'date',
        ];
    }
}
