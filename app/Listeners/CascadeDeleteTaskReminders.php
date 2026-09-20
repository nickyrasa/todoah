<?php

namespace App\Listeners;

use App\Models\Task;

/**
 * Un rappel n'a aucun sens en dehors de sa tâche : il disparaît avec elle.
 */
class CascadeDeleteTaskReminders
{
    public function handle(Task $task): void
    {
        $task->reminders()->delete();
    }
}
