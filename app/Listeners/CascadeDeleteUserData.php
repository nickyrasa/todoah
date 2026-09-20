<?php

namespace App\Listeners;

use App\Models\GroupActivity;
use App\Models\GroupInvitation;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\DB;

/**
 * Nettoie les données personnelles d'un utilisateur avant sa suppression.
 * Les groupes qu'il possède sont traités séparément (CascadeDeleteOwnedGroups).
 */
class CascadeDeleteUserData
{
    public function handle(User $user): void
    {
        // Une tâche confiée à un proche ne disparaît pas avec son créateur :
        // elle devient auto-créée par la personne qui doit la réaliser.
        Task::query()
            ->where('created_by_user_id', $user->id)
            ->where('user_id', '!=', $user->id)
            ->update(['created_by_user_id' => DB::raw('user_id')]);

        $user->tasks->each->delete();
        $user->routines->each->delete();
        $user->projects->each->delete();

        $user->groupMemberships()->delete();

        GroupInvitation::query()
            ->where('invited_by_user_id', $user->id)
            ->orWhere('invited_user_id', $user->id)
            ->delete();

        GroupActivity::query()->where('actor_id', $user->id)->delete();

        $user->progression?->delete();
        $user->progressionEvents()->delete();
    }
}
