<?php

namespace App\Listeners;

use App\Models\Group;

/**
 * Supprimer un groupe ne doit jamais supprimer les tâches/projets/routines
 * personnels de ses membres : elles redeviennent simplement personnelles.
 */
class CascadeDeleteGroupData
{
    public function handle(Group $group): void
    {
        $group->tasks()->update(['group_id' => null]);
        $group->projects()->update(['group_id' => null]);
        $group->routines()->update(['group_id' => null]);

        $group->memberships()->delete();
        $group->invitations()->delete();
        $group->activities()->delete();
    }
}
