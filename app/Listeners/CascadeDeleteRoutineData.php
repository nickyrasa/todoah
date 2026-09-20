<?php

namespace App\Listeners;

use App\Models\Routine;

/**
 * Supprimer une routine ne doit pas effacer l'historique déjà accompli :
 * seules les occurrences futures et non faites disparaissent avec elle. Les
 * occurrences passées ou terminées restent en tant que tâches autonomes
 * (leur lien vers la routine est simplement retiré).
 */
class CascadeDeleteRoutineData
{
    public function handle(Routine $routine): void
    {
        $routine->tasks()
            ->whereNull('completed_at')
            ->where('scheduled_for', '>=', today())
            ->get()
            ->each->delete();

        $routine->tasks()->update(['routine_id' => null]);

        $routine->reminders()->delete();
    }
}
