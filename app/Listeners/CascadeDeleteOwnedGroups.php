<?php

namespace App\Listeners;

use App\Models\User;

/**
 * Un groupe dont le propriétaire est supprimé est fermé : il n'y a pas de
 * transfert de propriété en v1. Le groupe disparaît (CascadeDeleteGroupData
 * s'occupe de ne pas toucher aux tâches/projets/routines personnels des
 * autres membres).
 */
class CascadeDeleteOwnedGroups
{
    public function handle(User $user): void
    {
        $user->ownedGroups->each->delete();
    }
}
