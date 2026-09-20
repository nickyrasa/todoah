<?php

namespace App\Models;

use App\Enums\ReminderAnchor;
use App\Enums\ReminderChannel;
use Database\Factories\RoutineReminderFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['routine_id', 'anchor', 'offset_minutes', 'channel', 'is_active'])]
class RoutineReminder extends Model
{
    /** @use HasFactory<RoutineReminderFactory> */
    use HasFactory;

    public function routine(): BelongsTo
    {
        return $this->belongsTo(Routine::class);
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
            'anchor' => ReminderAnchor::class,
            'channel' => ReminderChannel::class,
            'offset_minutes' => 'integer',
            'is_active' => 'boolean',
        ];
    }
}
