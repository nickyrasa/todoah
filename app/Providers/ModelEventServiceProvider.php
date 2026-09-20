<?php

namespace App\Providers;

use App\Listeners\CascadeDeleteGroupData;
use App\Listeners\CascadeDeleteOwnedGroups;
use App\Listeners\CascadeDeleteProjectTasks;
use App\Listeners\CascadeDeleteRoutineData;
use App\Listeners\CascadeDeleteTaskReminders;
use App\Listeners\CascadeDeleteUserData;
use App\Models\Group;
use App\Models\Project;
use App\Models\Routine;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\ServiceProvider;

/**
 * Point d'entrée unique des suppressions en chaîne : aucune clé étrangère
 * n'utilise `onDelete('cascade')`, tout passe par des listeners applicatifs
 * enregistrés ici (voir les docblocks des migrations concernées).
 */
class ModelEventServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        User::deleting(CascadeDeleteOwnedGroups::class);
        User::deleting(CascadeDeleteUserData::class);
        Group::deleting(CascadeDeleteGroupData::class);
        Routine::deleting(CascadeDeleteRoutineData::class);
        Project::deleting(CascadeDeleteProjectTasks::class);
        Task::deleting(CascadeDeleteTaskReminders::class);
    }
}
