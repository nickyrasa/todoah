<?php

namespace App\Models;

use App\Enums\ProgressionEventType;
use Database\Factories\ProgressionEventFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

#[Fillable([
    'user_id',
    'type',
    'xp_awarded',
    'label_key',
    'label_params',
    'subject_type',
    'subject_id',
    'occurred_at',
])]
class ProgressionEvent extends Model
{
    /** @use HasFactory<ProgressionEventFactory> */
    use HasFactory;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Élément à l'origine de l'événement (tâche, routine, projet...), sans clé
     * étrangère : le journal survit à la disparition de son sujet.
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
            'type' => ProgressionEventType::class,
            'xp_awarded' => 'integer',
            'label_params' => 'array',
            'occurred_at' => 'datetime',
        ];
    }
}
