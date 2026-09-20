<?php

namespace App\Models;

use Database\Factories\UserProgressionFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable([
    'user_id',
    'level',
    'total_xp',
    'momentum_score',
    'momentum_computed_at',
    'avatar_variant',
])]
class UserProgression extends Model
{
    /** @use HasFactory<UserProgressionFactory> */
    use HasFactory;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'level' => 'integer',
            'total_xp' => 'integer',
            'momentum_score' => 'decimal:2',
            'momentum_computed_at' => 'datetime',
        ];
    }
}
