<?php

namespace App\Models;

use App\Enums\DayPart;
use Database\Factories\TaskFactory;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Une tâche n'a pas de statut stocké : son état se lit dans ses horodatages.
 * Aucun attribut ne matérialise un échec — un dépassement de date se déduit à
 * la volée et reste une simple information de replanification.
 */
#[Fillable([
    'user_id',
    'created_by_user_id',
    'group_id',
    'project_id',
    'routine_id',
    'title',
    'notes',
    'day_part',
    'scheduled_for',
    'scheduled_at',
    'estimated_minutes',
    'position',
    'is_ai_suggested',
    'completed_at',
    'skipped_at',
    'snoozed_until',
])]
class Task extends Model
{
    /** @use HasFactory<TaskFactory> */
    use HasFactory;

    /**
     * Personne qui réalise la tâche.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Personne qui a créé la tâche, qui peut être un autre membre du groupe.
     */
    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by_user_id');
    }

    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class);
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function routine(): BelongsTo
    {
        return $this->belongsTo(Routine::class);
    }

    public function reminders(): HasMany
    {
        return $this->hasMany(Reminder::class);
    }

    public function isCompleted(): bool
    {
        return $this->completed_at !== null;
    }

    /**
     * La date prévue est-elle passée alors que la tâche est encore ouverte ?
     *
     * Calculé à la volée, jamais stocké.
     */
    public function isOverdue(): bool
    {
        if ($this->scheduled_for === null || $this->completed_at !== null) {
            return false;
        }

        return $this->scheduled_for->isBefore(today());
    }

    public function wasAssignedByAnotherMember(): bool
    {
        return $this->created_by_user_id !== $this->user_id;
    }

    #[Scope]
    protected function completed(Builder $query): void
    {
        $query->whereNotNull('completed_at');
    }

    #[Scope]
    protected function open(Builder $query): void
    {
        $query->whereNull('completed_at');
    }

    #[Scope]
    protected function scheduledOn(Builder $query, DateTimeInterface|string $date): void
    {
        $query->whereDate('scheduled_for', $date);
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
            'scheduled_for' => 'date',
            'scheduled_at' => 'datetime',
            'estimated_minutes' => 'integer',
            'position' => 'integer',
            'is_ai_suggested' => 'boolean',
            'completed_at' => 'datetime',
            'skipped_at' => 'datetime',
            'snoozed_until' => 'datetime',
        ];
    }
}
