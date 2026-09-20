<?php

namespace App\Models;

use App\Enums\GroupActivityType;
use Database\Factories\GroupActivityFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

#[Fillable([
    'group_id',
    'actor_id',
    'type',
    'label_key',
    'label_params',
    'subject_type',
    'subject_id',
    'occurred_at',
])]
class GroupActivity extends Model
{
    /** @use HasFactory<GroupActivityFactory> */
    use HasFactory;

    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class);
    }

    public function actor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'actor_id');
    }

    /**
     * Sujet de l'activité (une tâche, un projet...), sans clé étrangère :
     * l'entrée du flux survit à la disparition de son sujet.
     */
    public function subject(): MorphTo
    {
        return $this->morphTo();
    }

    #[Scope]
    protected function mostRecentFirst(Builder $query): void
    {
        $query->orderByDesc('occurred_at');
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'type' => GroupActivityType::class,
            'label_params' => 'array',
            'occurred_at' => 'datetime',
        ];
    }
}
