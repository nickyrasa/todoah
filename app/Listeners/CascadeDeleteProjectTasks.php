<?php

namespace App\Listeners;

use App\Models\Project;

class CascadeDeleteProjectTasks
{
    public function handle(Project $project): void
    {
        $project->tasks()->get()->each->delete();
    }
}
