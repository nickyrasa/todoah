<?php

namespace App\Models;

use Database\Factories\ProjectFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable([
    'user_id',
    'group_id',
    'name',
    'description',
    'due_on',
    'ai_breakdown_requested_at',
    'ai_breakdown_completed_at',
    'completed_at',
    'position',
])]
class Project extends Model
{
    /** @use HasFactory<ProjectFactory> */
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

    /**
     * Part des tâches du projet déjà terminées, en pourcentage entier.
     *
     * Jamais stockée : recalculée à la lecture pour qu'aucune colonne ne puisse
     * se désynchroniser des tâches réelles.
     */
    public function progressPercent(): int
    {
        $tasks = $this->relationLoaded('tasks') ? $this->tasks : $this->tasks()->get();
        $total = $tasks->count();

        if ($total === 0) {
            return 0;
        }

        $completed = $tasks->whereNotNull('completed_at')->count();

        return (int) round($completed / $total * 100);
    }

    public function isCompleted(): bool
    {
        return $this->completed_at !== null;
    }

    public function hasAiBreakdown(): bool
    {
        return $this->ai_breakdown_completed_at !== null;
    }

    #[Scope]
    protected function inProgress(Builder $query): void
    {
        $query->whereNull('completed_at');
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'due_on' => 'date',
            'ai_breakdown_requested_at' => 'datetime',
            'ai_breakdown_completed_at' => 'datetime',
            'completed_at' => 'datetime',
            'position' => 'integer',
        ];
    }
}
