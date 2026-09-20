<?php

namespace Tests\Feature;

use App\Models\Group;
use App\Models\GroupActivity;
use App\Models\GroupInvitation;
use App\Models\GroupMembership;
use App\Models\ProgressionEvent;
use App\Models\Project;
use App\Models\Reminder;
use App\Models\Routine;
use App\Models\RoutineReminder;
use App\Models\Task;
use App\Models\User;
use App\Models\UserProgression;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AccountDeletionCascadeTest extends TestCase
{
    use RefreshDatabase;

    public function test_deleting_a_user_removes_their_tasks_projects_routines_and_progression(): void
    {
        $user = User::factory()->create();

        $project = Project::factory()->forUser($user)->create();
        $projectTask = Task::factory()->forProject($project)->create();

        $routine = Routine::factory()->forUser($user)->create();
        RoutineReminder::factory()->for($routine)->create();
        $futureUndoneOccurrence = Task::factory()->fromRoutine($routine, today()->addDay()->toDateString())->create();

        $standaloneTask = Task::factory()->forUser($user)->create();
        Reminder::factory()->forTask($standaloneTask)->create();

        UserProgression::factory()->for($user)->create();
        ProgressionEvent::factory()->for($user)->create();

        $user->delete();

        $this->assertModelMissing($projectTask);
        $this->assertModelMissing($project);
        $this->assertModelMissing($routine);
        $this->assertDatabaseMissing('routine_reminders', ['routine_id' => $routine->id]);
        $this->assertModelMissing($futureUndoneOccurrence);
        $this->assertModelMissing($standaloneTask);
        $this->assertDatabaseMissing('reminders', ['task_id' => $standaloneTask->id]);
        $this->assertDatabaseMissing('user_progressions', ['user_id' => $user->id]);
        $this->assertDatabaseMissing('progression_events', ['user_id' => $user->id]);
    }

    public function test_deleting_a_routine_keeps_its_completed_occurrences_but_drops_future_undone_ones(): void
    {
        $user = User::factory()->create();
        $routine = Routine::factory()->forUser($user)->create();

        $completedOccurrence = Task::factory()->fromRoutine($routine)->completed()->create();
        $pastUndoneOccurrence = Task::factory()->fromRoutine($routine, today()->subDay()->toDateString())->create();
        $futureUndoneOccurrence = Task::factory()->fromRoutine($routine, today()->addDay()->toDateString())->create();

        $routine->delete();

        $this->assertModelExists($completedOccurrence);
        $this->assertNull($completedOccurrence->fresh()->routine_id);

        $this->assertModelExists($pastUndoneOccurrence);
        $this->assertNull($pastUndoneOccurrence->fresh()->routine_id);

        $this->assertModelMissing($futureUndoneOccurrence);
    }

    public function test_deleting_a_group_keeps_members_personal_tasks_but_ungroups_them(): void
    {
        $owner = User::factory()->create();
        $member = User::factory()->create();
        $group = Group::factory()->ownedBy($owner)->create();
        GroupMembership::factory()->forMember($group, $member)->create();
        GroupInvitation::factory()->for($group)->create(['invited_by_user_id' => $owner->id]);
        GroupActivity::factory()->for($group)->create(['actor_id' => $owner->id]);

        $memberTask = Task::factory()->forUser($member)->forGroup($group)->create();

        $group->delete();

        $this->assertModelExists($memberTask);
        $this->assertNull($memberTask->fresh()->group_id);
        $this->assertDatabaseMissing('group_memberships', ['group_id' => $group->id]);
        $this->assertDatabaseMissing('group_invitations', ['group_id' => $group->id]);
        $this->assertDatabaseMissing('group_activities', ['group_id' => $group->id]);
    }

    public function test_deleting_the_owner_of_a_group_closes_the_group_without_touching_members_tasks(): void
    {
        $owner = User::factory()->create();
        $member = User::factory()->create();
        $group = Group::factory()->ownedBy($owner)->create();
        GroupMembership::factory()->forMember($group, $member)->create();

        $memberTask = Task::factory()->forUser($member)->forGroup($group)->create();

        $owner->delete();

        $this->assertModelMissing($group);
        $this->assertModelExists($memberTask);
        $this->assertNull($memberTask->fresh()->group_id);
    }

    public function test_deleting_the_creator_of_an_assigned_task_reassigns_it_to_its_owner(): void
    {
        $assigner = User::factory()->create();
        $assignee = User::factory()->create();
        $task = Task::factory()->forUser($assignee)->assignedBy($assigner)->create();

        $assigner->delete();

        $task->refresh();
        $this->assertModelExists($task);
        $this->assertSame($assignee->id, $task->created_by_user_id);
    }
}
