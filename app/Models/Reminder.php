<?php

namespace App\Models;

use App\Enums\ReminderAnchor;
use App\Enums\ReminderChannel;
use Database\Factories\ReminderFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable([
    'task_id',
    'anchor',
    'offset_minutes',
    'channel',
    'scheduled_at',
    'sent_at',
    'dismissed_at',
    'is_active',
])]
class Reminder extends Model
{
    /** @use HasFactory<ReminderFactory> */
    use HasFactory;

    public function task(): BelongsTo
    {
        return $this->belongsTo(Task::class);
    }

    public function isSent(): bool
    {
        return $this->sent_at !== null;
    }

    /**
     * Rappels actifs dont l'heure est passée et qui n'ont pas encore été envoyés.
     */
    #[Scope]
    protected function readyToSend(Builder $query): void
    {
        $query->where('is_active', true)
            ->whereNull('sent_at')
            ->whereNull('dismissed_at')
            ->whereNotNull('scheduled_at')
            ->where('scheduled_at', '<=', now());
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'anchor' => ReminderAnchor::class,
            'channel' => ReminderChannel::class,
            'offset_minutes' => 'integer',
            'scheduled_at' => 'datetime',
            'sent_at' => 'datetime',
            'dismissed_at' => 'datetime',
            'is_active' => 'boolean',
        ];
    }
}
