<?php

namespace Database\Seeders;

use App\Enums\DayPart;
use App\Enums\GroupActivityType;
use App\Enums\ProgressionEventType;
use App\Enums\ReminderAnchor;
use App\Enums\RoutineFrequency;
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
use Database\Factories\TaskFactory;
use Illuminate\Database\Seeder;

/**
 * Jeu de démonstration reprenant les données jusqu'ici codées en dur dans les
 * composants Livewire (tableau de bord, projets & routines, groupe, widget
 * avatar), pour qu'elles existent réellement en base.
 */
class DemoSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $owner = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $lea = User::factory()->create([
            'name' => 'Léa Martin',
            'email' => 'lea@example.com',
        ]);

        $sam = User::factory()->create([
            'name' => 'Sam Dubois',
            'email' => 'sam@example.com',
        ]);

        $group = $this->seedGroup($owner, $lea, $sam);
        $movingSteps = $this->seedProjects($owner);
        $routine = $this->seedEveningRoutine($owner);
        $groupTasks = $this->seedTodayTasks($owner, $lea, $sam, $group, $routine);

        $this->seedProgression($owner, $routine, $movingSteps['Réserver le camion']);
        $this->seedGroupActivity($group, $owner, $lea, $sam, $groupTasks, $movingSteps['Réserver le camion']);
    }

    /**
     * Le groupe « Famille » : l'utilisateur courant plus deux proches.
     */
    private function seedGroup(User $owner, User $lea, User $sam): Group
    {
        $group = Group::factory()->ownedBy($owner)->create([
            'name' => 'Famille',
        ]);

        GroupMembership::factory()->forMember($group, $owner, 'Toi')->create([
            'joined_at' => now()->subMonths(3),
        ]);

        GroupMembership::factory()->forMember($group, $lea, 'Léa')->create([
            'joined_at' => now()->subMonths(3),
        ]);

        GroupMembership::factory()->forMember($group, $sam, 'Sam')->create([
            'joined_at' => now()->subMonths(2),
        ]);

        GroupInvitation::factory()->create([
            'group_id' => $group->id,
            'invited_by_user_id' => $owner->id,
            'email' => 'mamie@example.com',
        ]);

        return $group;
    }

    /**
     * Les trois projets de la maquette, avec des étapes réelles : l'avancement
     * affiché (20 %, 60 %, 0 %) se recalcule depuis ces tâches.
     *
     * @return array<string, Task> Les étapes du déménagement, indexées par titre.
     */
    private function seedProjects(User $owner): array
    {
        $birthday = Project::factory()->forUser($owner)->create([
            'name' => 'Anniversaire de Mia',
            'description' => 'Organiser la fête des 7 ans.',
            'due_on' => today()->addWeeks(3),
            'position' => 0,
        ]);

        $this->seedProjectSteps($birthday, [
            ['title' => 'Réserver la salle', 'completed' => true],
            ['title' => 'Commander le gâteau'],
            ['title' => 'Envoyer les invitations'],
            ['title' => 'Choisir la décoration'],
            ['title' => 'Préparer la playlist'],
        ]);

        $moving = Project::factory()->forUser($owner)->withAiBreakdown()->create([
            'name' => 'Déménagement',
            'description' => 'Changement d\'appartement fin du mois.',
            'due_on' => today()->addWeeks(6),
            'position' => 1,
        ]);

        $movingSteps = $this->seedProjectSteps($moving, [
            ['title' => 'Réserver le camion', 'completed' => true, 'suggested' => true],
            ['title' => 'Trier les cartons', 'completed' => true, 'suggested' => true],
            ['title' => 'Changer d\'adresse EDF'],
            ['title' => 'Faire suivre le courrier', 'completed' => true],
            ['title' => 'Rendre les clés'],
        ]);

        // Planifiee aujourd'hui pour apparaitre sur le tableau de bord, a cote
        // des taches personnelles : demontre la vue fusionnee perso + projets.
        $movingSteps['Changer d\'adresse EDF']->update([
            'day_part' => DayPart::Afternoon,
            'scheduled_for' => today(),
        ]);

        $paperwork = Project::factory()->forUser($owner)->create([
            'name' => 'Dossier CPAM',
            'due_on' => today()->addWeeks(2),
            'position' => 2,
        ]);

        $this->seedProjectSteps($paperwork, [
            ['title' => 'Rassembler les justificatifs'],
            ['title' => 'Remplir le formulaire'],
            ['title' => 'Envoyer le dossier'],
        ]);

        return $movingSteps;
    }

    /**
     * @param  array<int, array{title: string, completed?: bool, suggested?: bool}>  $steps
     * @return array<string, Task>
     */
    private function seedProjectSteps(Project $project, array $steps): array
    {
        $tasks = [];

        foreach ($steps as $position => $step) {
            $tasks[$step['title']] = Task::factory()
                ->forProject($project)
                ->when($step['completed'] ?? false, fn (TaskFactory $factory) => $factory->completed())
                ->when($step['suggested'] ?? false, fn (TaskFactory $factory) => $factory->aiSuggested())
                ->create([
                    'title' => $step['title'],
                    'position' => $position,
                ]);
        }

        return $tasks;
    }

    private function seedEveningRoutine(User $owner): Routine
    {
        $routine = Routine::factory()->forUser($owner)->create([
            'name' => 'Routine du soir',
            'day_part' => DayPart::Evening,
            'frequency' => RoutineFrequency::Daily,
            'interval' => 1,
            'starts_on' => today()->subWeeks(3),
            'suggested_time' => '20:30',
            'last_materialized_on' => today(),
        ]);

        RoutineReminder::factory()->forRoutine($routine)->anchoredAt(ReminderAnchor::BeforeStart)->create();
        RoutineReminder::factory()->forRoutine($routine)->anchoredAt(ReminderAnchor::AtStart)->create();

        return $routine;
    }

    /**
     * Les tâches du jour affichées sur le tableau de bord, plus les deux tâches
     * partagées avec le groupe.
     *
     * @return array<string, Task>
     */
    private function seedTodayTasks(User $owner, User $lea, User $sam, Group $group, Routine $routine): array
    {
        Task::factory()->forUser($owner)->create([
            'title' => 'Préparer le sac',
            'day_part' => DayPart::Morning,
            'scheduled_for' => today(),
            'estimated_minutes' => 10,
            'position' => 0,
        ]);

        $medication = Task::factory()->forUser($owner)->create([
            'title' => 'Prendre le traitement',
            'day_part' => DayPart::Morning,
            'scheduled_for' => today(),
            'estimated_minutes' => 5,
            'position' => 1,
        ]);

        Reminder::factory()->forTask($medication)->anchoredAt(ReminderAnchor::BeforeStart)->create([
            'scheduled_at' => today()->setTime(7, 45),
        ]);

        Task::factory()->forUser($owner)->create([
            'title' => 'Appeler la banque',
            'day_part' => DayPart::Afternoon,
            'scheduled_for' => today(),
            'estimated_minutes' => 15,
            'position' => 0,
        ]);

        Task::factory()->fromRoutine($routine)->create([
            'estimated_minutes' => 20,
            'position' => 0,
        ]);

        $livingRoom = Task::factory()->forUser($lea)->forGroup($group)->completed()->create([
            'title' => 'Ranger le salon',
            'day_part' => DayPart::Morning,
            'scheduled_for' => today(),
            'position' => 0,
        ]);

        $bins = Task::factory()->forUser($owner)->assignedBy($sam)->forGroup($group)->create([
            'title' => 'Sortir les poubelles',
            'day_part' => DayPart::Evening,
            'scheduled_for' => today(),
            'position' => 1,
        ]);

        return ['livingRoom' => $livingRoom, 'bins' => $bins];
    }

    /**
     * Le parcours affiché par le widget avatar : niveau 4 aujourd'hui, après
     * trois jalons antérieurs. Que du positif, par construction.
     */
    private function seedProgression(User $owner, Routine $routine, Task $completedStep): void
    {
        UserProgression::factory()->atLevel(4, 520)->create([
            'user_id' => $owner->id,
            'momentum_score' => 72.50,
            'momentum_computed_at' => now(),
            'avatar_variant' => 'sapling',
        ]);

        ProgressionEvent::factory()
            ->ofType(ProgressionEventType::MilestoneReached)
            ->about($routine)
            ->create([
                'user_id' => $owner->id,
                'label_key' => 'progression.milestones.first_routine_created',
                'occurred_at' => now()->subWeeks(3),
            ]);

        ProgressionEvent::factory()
            ->ofType(ProgressionEventType::LevelUp, ['level' => 2])
            ->create([
                'user_id' => $owner->id,
                'occurred_at' => now()->subWeeks(2),
            ]);

        ProgressionEvent::factory()
            ->ofType(ProgressionEventType::MilestoneReached, ['days' => 7])
            ->create([
                'user_id' => $owner->id,
                'label_key' => 'progression.milestones.momentum_streak',
                'occurred_at' => now()->subWeek(),
            ]);

        ProgressionEvent::factory()
            ->ofType(ProgressionEventType::TaskCompleted)
            ->about($completedStep)
            ->create([
                'user_id' => $owner->id,
                'label_params' => ['task' => $completedStep->title],
                'occurred_at' => now()->subDays(2),
            ]);

        ProgressionEvent::factory()
            ->ofType(ProgressionEventType::RoutineStreakMaintained, ['days' => 5])
            ->about($routine)
            ->create([
                'user_id' => $owner->id,
                'occurred_at' => now()->subDay(),
            ]);

        ProgressionEvent::factory()
            ->ofType(ProgressionEventType::LevelUp, ['level' => 4])
            ->create([
                'user_id' => $owner->id,
                'occurred_at' => now(),
            ]);
    }

    /**
     * Le flux d'activité du groupe repris de la maquette.
     *
     * @param  array<string, Task>  $groupTasks
     */
    private function seedGroupActivity(
        Group $group,
        User $owner,
        User $lea,
        User $sam,
        array $groupTasks,
        Task $completedStep,
    ): void {
        GroupActivity::factory()
            ->ofType(GroupActivityType::MemberJoined)
            ->create([
                'group_id' => $group->id,
                'actor_id' => $sam->id,
                'label_params' => ['actor' => 'Sam'],
                'occurred_at' => now()->subMonths(2),
            ]);

        GroupActivity::factory()
            ->ofType(GroupActivityType::TaskCompleted)
            ->about($completedStep)
            ->create([
                'group_id' => $group->id,
                'actor_id' => $owner->id,
                'label_params' => ['actor' => 'Toi', 'task' => $completedStep->title],
                'occurred_at' => now()->subDay(),
            ]);

        GroupActivity::factory()
            ->ofType(GroupActivityType::TaskAssigned)
            ->about($groupTasks['bins'])
            ->create([
                'group_id' => $group->id,
                'actor_id' => $sam->id,
                'label_params' => ['actor' => 'Sam', 'task' => $groupTasks['bins']->title, 'assignee' => 'Toi'],
                'occurred_at' => now()->subHours(5),
            ]);

        GroupActivity::factory()
            ->ofType(GroupActivityType::TaskCompleted)
            ->about($groupTasks['livingRoom'])
            ->create([
                'group_id' => $group->id,
                'actor_id' => $lea->id,
                'label_params' => ['actor' => 'Léa', 'task' => $groupTasks['livingRoom']->title],
                'occurred_at' => now()->subHours(2),
            ]);
    }
}
