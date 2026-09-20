<?php

use App\Enums\DayPart;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;

new #[Layout('layouts.app')] class extends Component
{
    public string $newTask = '';

    public string $newTaskProjectId = '';

    public string $newProjectName = '';

    public ?int $openProjectId = null;

    public string $newSubtask = '';

    /**
     * Projets encore en cours, proposes lors de l'ajout rapide pour rattacher
     * une tache a un projet sans quitter "Aujourd'hui".
     */
    #[Computed]
    public function activeProjects()
    {
        return Auth::user()->projects()->inProgress()->orderBy('position')->get();
    }

    /**
     * Les taches du jour, personnelles ou issues d'un projet/routine, groupees
     * par moment de la journee. Une tache sans moment defini (frequent pour une
     * etape de projet) atterrit dans le seau "anytime".
     *
     * @return array<string, \Illuminate\Support\Collection<int, Task>>
     */
    #[Computed]
    public function tasksByPeriod(): array
    {
        $tasks = Auth::user()->tasks()
            ->with('project')
            ->scheduledOn(today())
            ->orderBy('position')
            ->get()
            ->groupBy(fn (Task $task) => $task->day_part?->value ?? 'anytime');

        return collect(DayPart::cases())
            ->pluck('value')
            ->push('anytime')
            ->mapWithKeys(fn (string $period) => [$period => $tasks->get($period, collect())])
            ->all();
    }

    /**
     * La seule tache mise en avant : la premiere non terminee, tous moments
     * confondus. Le focus reste unique pour ne pas remettre une liste plate.
     */
    #[Computed]
    public function nextTask(): ?Task
    {
        foreach ($this->tasksByPeriod as $tasks) {
            $next = $tasks->first(fn (Task $task) => ! $task->isCompleted());

            if ($next) {
                return $next;
            }
        }

        return null;
    }

    /**
     * @return \Illuminate\Support\Collection<int, Project>
     */
    #[Computed]
    public function projects(): \Illuminate\Support\Collection
    {
        return Auth::user()->projects()
            ->with('tasks')
            ->orderBy('position')
            ->get();
    }

    #[Computed]
    public function openProject(): ?Project
    {
        if ($this->openProjectId === null) {
            return null;
        }

        return Auth::user()->projects()->with('tasks')->find($this->openProjectId);
    }

    public function addTask(): void
    {
        $label = trim($this->newTask);

        if ($label === '') {
            return;
        }

        $projectId = $this->newTaskProjectId !== '' ? (int) $this->newTaskProjectId : null;

        if ($projectId !== null && ! Auth::user()->projects()->whereKey($projectId)->exists()) {
            $projectId = null;
        }

        $position = Auth::user()->tasks()
            ->scheduledOn(today())
            ->where('day_part', DayPart::Morning)
            ->max('position');

        Auth::user()->tasks()->create([
            'created_by_user_id' => Auth::id(),
            'project_id' => $projectId,
            'title' => $label,
            'day_part' => DayPart::Morning,
            'scheduled_for' => today(),
            'position' => $position === null ? 0 : $position + 1,
        ]);

        $this->newTask = '';
        $this->newTaskProjectId = '';
    }

    public function toggle(int $taskId): void
    {
        $task = Auth::user()->tasks()->findOrFail($taskId);
        $task->completed_at = $task->isCompleted() ? null : now();
        $task->save();
    }

    public function createProject(): void
    {
        $name = trim($this->newProjectName);

        if ($name === '') {
            return;
        }

        $position = Auth::user()->projects()->max('position');

        Auth::user()->projects()->create([
            'name' => $name,
            'position' => $position === null ? 0 : $position + 1,
        ]);

        $this->newProjectName = '';
    }

    public function openProjectPanel(int $projectId): void
    {
        Auth::user()->projects()->findOrFail($projectId);

        $this->openProjectId = $projectId;
    }

    public function closeProjectPanel(): void
    {
        $this->openProjectId = null;
    }

    public function addSubtask(): void
    {
        $label = trim($this->newSubtask);

        if ($label === '' || $this->openProjectId === null) {
            return;
        }

        $project = Auth::user()->projects()->findOrFail($this->openProjectId);

        $position = $project->tasks()->max('position');

        $project->tasks()->create([
            'user_id' => $project->user_id,
            'created_by_user_id' => Auth::id(),
            'group_id' => $project->group_id,
            'title' => $label,
            'position' => $position === null ? 0 : $position + 1,
        ]);

        $this->newSubtask = '';
    }

    public function toggleSubtask(int $taskId): void
    {
        if ($this->openProjectId === null) {
            return;
        }

        $project = Auth::user()->projects()->findOrFail($this->openProjectId);
        $task = $project->tasks()->findOrFail($taskId);
        $task->completed_at = $task->isCompleted() ? null : now();
        $task->save();
    }
};
?>

@php
    $periodLabels = [
        'morning' => DayPart::Morning->label(),
        'afternoon' => DayPart::Afternoon->label(),
        'evening' => DayPart::Evening->label(),
        'anytime' => "A un moment de la journee",
    ];
    $periodIcons = [
        'morning' => '<path d="M12 3v3M4.2 6.2l2 2M19.8 6.2l-2 2M3 13h2M19 13h2"/><path d="M6 13a6 6 0 0 1 12 0"/><path d="M4 17h16"/>',
        'afternoon' => '<circle cx="12" cy="12" r="4.2"/><path d="M12 3v2M12 19v2M4.9 4.9l1.4 1.4M17.7 17.7l1.4 1.4M3 12h2M19 12h2M4.9 19.1l1.4-1.4M17.7 6.3l1.4-1.4"/>',
        'evening' => '<path d="M20 14.3A7.9 7.9 0 0 1 9.7 4a8 8 0 1 0 10.3 10.3Z"/>',
        'anytime' => '<path d="M8 6h12M8 12h12M8 18h12"/><circle cx="3.5" cy="6" r="1.3"/><circle cx="3.5" cy="12" r="1.3"/><circle cx="3.5" cy="18" r="1.3"/>',
    ];
    $nextTask = $this->nextTask;
@endphp

<div x-data class="mx-auto max-w-6xl px-4 py-6 sm:px-8 sm:py-10">
    <div class="pr-16 sm:pr-0">
        <h1 class="text-2xl font-extrabold tracking-tight text-[var(--color-text)] sm:text-3xl">Aujourd'hui</h1>
        <p class="mt-1 text-sm text-[var(--color-text-2)]">{{ now()->locale('fr')->isoFormat('dddd D MMMM') }}</p>
    </div>

    <form wire:submit="addTask" class="mt-6 flex items-center gap-3 rounded-2xl border border-[var(--color-border)] bg-[var(--color-surface)] py-2 pl-2 pr-3 shadow-sm">
        <span class="btn-ink flex h-9 w-9 shrink-0 items-center justify-center rounded-full text-base leading-none">+</span>
        <input
            type="text"
            wire:model="newTask"
            placeholder="Ajouter une tache..."
            class="w-full min-w-0 bg-transparent text-sm font-medium text-[var(--color-text)] placeholder:text-[var(--color-text-2)] focus:outline-none"
        >
        @if ($this->activeProjects->isNotEmpty())
            <select
                wire:model="newTaskProjectId"
                title="Rattacher a un projet"
                class="shrink-0 rounded-full border-none bg-[var(--color-surface-2)] px-3 py-1.5 text-xs font-bold text-[var(--color-text-2)] focus:outline-none"
            >
                <option value="">Perso</option>
                @foreach ($this->activeProjects as $project)
                    <option value="{{ $project->id }}">{{ $project->name }}</option>
                @endforeach
            </select>
        @endif
    </form>

    <div class="mt-8 grid grid-cols-1 gap-4 lg:grid-cols-[1.3fr_1fr]">
        {{-- Tuile focus : la seule tache mise en avant --}}
        <div class="btn-ink flex min-h-[220px] flex-col justify-between rounded-3xl p-7 shadow-md">
            <span class="text-xs font-bold uppercase tracking-widest text-white/60">Focus</span>
            @if ($nextTask)
                <div>
                    <p class="mt-3 text-2xl font-extrabold text-white">{{ $nextTask->title }}</p>
                    @if ($nextTask->project)
                        <p class="mt-2 text-sm font-semibold text-white/60">{{ $nextTask->project->name }}</p>
                    @endif
                </div>
                <button
                    type="button"
                    wire:click="toggle({{ $nextTask->id }})"
                    class="mt-6 w-fit rounded-full bg-white/15 px-5 py-2.5 text-sm font-bold text-white transition-colors hover:bg-white/25"
                >
                    Marquer fait
                </button>
            @else
                <p class="mt-3 text-lg font-bold text-white">Tout est fait pour aujourd'hui.</p>
            @endif
        </div>

        {{-- Tuiles compactes par moment de la journee --}}
        <div class="flex flex-col gap-4">
            @foreach ($this->tasksByPeriod as $period => $tasks)
                @continue($tasks->isEmpty())
                <div class="rounded-2xl bg-[var(--color-surface)] p-5 shadow-sm">
                    <h2 class="mb-3 flex items-center gap-2 text-xs font-bold uppercase tracking-wide text-[var(--color-text-2)]">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" class="h-3.5 w-3.5">
                            {!! $periodIcons[$period] !!}
                        </svg>
                        {{ $periodLabels[$period] }}
                    </h2>
                    <ul class="space-y-1.5">
                        @foreach ($tasks as $task)
                            <li>
                                <button
                                    type="button"
                                    wire:click="toggle({{ $task->id }})"
                                    class="flex w-full items-center gap-2.5 rounded-lg px-2 py-1.5 text-left transition-colors hover:bg-[var(--color-surface-2)]"
                                >
                                    <span @class([
                                        'flex h-4 w-4 shrink-0 items-center justify-center rounded-full border-2 text-[8px] font-black',
                                        'border-[var(--color-success)] bg-[var(--color-success)] text-white' => $task->isCompleted(),
                                        'border-[var(--color-text-2)] text-transparent' => ! $task->isCompleted(),
                                    ])>✓</span>
                                    <span @class([
                                        'min-w-0 flex-1 truncate text-sm font-semibold',
                                        'text-[var(--color-success)] line-through' => $task->isCompleted(),
                                        'text-[var(--color-text)]' => ! $task->isCompleted(),
                                    ])>
                                        {{ $task->title }}
                                    </span>
                                </button>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>
    </div>

    {{-- Projets & routines --}}
    <div class="mt-10">
        <div class="mb-4 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <h2 class="text-sm font-bold uppercase tracking-wide text-[var(--color-text-2)]">Projets &amp; routines</h2>
            <form wire:submit="createProject" class="flex items-center gap-2">
                <input
                    type="text"
                    wire:model="newProjectName"
                    placeholder="Nouveau projet..."
                    class="w-full min-w-0 rounded-full border border-[var(--color-border)] bg-[var(--color-surface)] px-4 py-1.5 text-xs font-semibold text-[var(--color-text)] placeholder:text-[var(--color-text-2)] focus:outline-none sm:w-44"
                >
                <button type="submit" class="btn-ink shrink-0 rounded-full px-4 py-1.5 text-xs font-bold">+ nouveau</button>
            </form>
        </div>

        @if ($this->projects->isEmpty())
            <p class="text-sm text-[var(--color-text-2)]">Pas encore de projet. Ajoute le premier ci-dessus.</p>
        @else
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($this->projects as $project)
                    <button
                        type="button"
                        wire:click="openProjectPanel({{ $project->id }})"
                        class="rounded-2xl bg-[var(--color-surface)] p-5 text-left shadow-sm transition-shadow hover:shadow-md"
                    >
                        <p class="truncate text-sm font-bold text-[var(--color-text)]">{{ $project->name }}</p>
                        <div class="mt-4 h-2 w-full rounded-full bg-[var(--color-surface-2)]">
                            <div class="h-2 rounded-full bg-[var(--color-success)]" style="width: {{ $project->progressPercent() }}%"></div>
                        </div>
                        <p class="mt-2 text-xs font-bold text-[var(--color-text-2)]">{{ $project->progressPercent() }}% des etapes faites</p>
                    </button>
                @endforeach
            </div>
        @endif
    </div>

    {{-- Panneau de detail d'un projet (memes codes visuels que le widget avatar) --}}
    <div
        x-show="$wire.openProjectId !== null"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 translate-x-2"
        x-transition:enter-end="opacity-100 translate-x-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-x-4 top-24 z-10 rounded-3xl border border-[var(--color-border)] bg-[var(--color-surface)] p-5 shadow-lg sm:inset-x-auto sm:right-6 sm:w-[380px]"
        x-cloak
    >
        @if ($this->openProject)
            <div class="mb-4 flex items-center justify-between">
                <h2 class="text-base font-extrabold text-[var(--color-text)]">{{ $this->openProject->name }}</h2>
                <button type="button" wire:click="closeProjectPanel" aria-label="Fermer" class="text-[var(--color-text-2)]">✕</button>
            </div>

            <div class="h-2 w-full rounded-full bg-[var(--color-surface-2)]">
                <div class="h-2 rounded-full bg-[var(--color-success)]" style="width: {{ $this->openProject->progressPercent() }}%"></div>
            </div>
            <p class="mt-2 text-xs font-semibold text-[var(--color-text-2)]">{{ $this->openProject->progressPercent() }}% des etapes faites</p>

            <ul class="mt-5 space-y-2">
                @foreach ($this->openProject->tasks as $subtask)
                    <li class="flex items-center gap-3 rounded-xl px-3 py-2.5 {{ $subtask->isCompleted() ? 'bg-[var(--color-success-soft)]' : 'bg-[var(--color-surface-2)]' }}">
                        <button
                            type="button"
                            wire:click="toggleSubtask({{ $subtask->id }})"
                            @class([
                                'flex h-5 w-5 shrink-0 items-center justify-center rounded-full border-2 text-[10px] font-black',
                                'border-[var(--color-success)] bg-[var(--color-success)] text-white' => $subtask->isCompleted(),
                                'border-[var(--color-text-2)] text-transparent' => ! $subtask->isCompleted(),
                            ])
                        >✓</button>
                        <span @class([
                            'text-sm font-semibold',
                            'text-[var(--color-success)] line-through' => $subtask->isCompleted(),
                            'text-[var(--color-text)]' => ! $subtask->isCompleted(),
                        ])>{{ $subtask->title }}</span>
                        @if ($subtask->is_ai_suggested)
                            <span class="ml-auto rounded-full bg-[var(--color-ai-soft)] px-2.5 py-1 text-[10px] font-extrabold uppercase text-[var(--color-ai)]">ia</span>
                        @endif
                    </li>
                @endforeach
            </ul>

            <form wire:submit="addSubtask" class="mt-3 flex items-center gap-2 rounded-xl border-2 border-dashed border-[var(--color-border)] px-3 py-2.5">
                <span class="text-[var(--color-text-2)]">+</span>
                <input
                    type="text"
                    wire:model="newSubtask"
                    placeholder="Ajouter une etape..."
                    class="w-full bg-transparent text-sm font-semibold text-[var(--color-text)] placeholder:font-normal placeholder:text-[var(--color-text-2)] focus:outline-none"
                >
            </form>
        @endif
    </div>
</div>
