<?php

use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;

new #[Layout('layouts.app')] class extends Component
{
    public ?int $selectedProjectId = null;

    public string $step = 'decoupage';

    public bool $addingProject = false;

    public string $newProjectName = '';

    public string $projectName = '';

    public string $newSubtask = '';

    /**
     * @return \Illuminate\Support\Collection<int, Project>
     */
    #[Computed]
    public function projects()
    {
        return Auth::user()->projects()
            ->with(['tasks' => fn ($query) => $query->orderBy('position')])
            ->orderBy('position')
            ->get();
    }

    #[Computed]
    public function selectedProject(): ?Project
    {
        if ($this->selectedProjectId === null) {
            return $this->projects->first();
        }

        return $this->projects->firstWhere('id', $this->selectedProjectId);
    }

    public function select(int $projectId): void
    {
        $this->selectedProjectId = $projectId;
        $this->step = 'decoupage';
    }

    public function goToStep(string $step): void
    {
        $this->step = $step;

        if ($step === 'nom' && $this->selectedProject) {
            $this->projectName = $this->selectedProject->name;
        }
    }

    public function startAddingProject(): void
    {
        $this->addingProject = true;
    }

    public function addProject(): void
    {
        $name = trim($this->newProjectName);

        if ($name === '') {
            return;
        }

        $position = Auth::user()->projects()->max('position');

        $project = Auth::user()->projects()->create([
            'name' => $name,
            'position' => $position === null ? 0 : $position + 1,
        ]);

        $this->newProjectName = '';
        $this->addingProject = false;
        $this->selectedProjectId = $project->id;
        $this->step = 'decoupage';
    }

    public function renameProject(): void
    {
        $name = trim($this->projectName);

        if ($name === '' || ! $this->selectedProject) {
            return;
        }

        $this->selectedProject->update(['name' => $name]);
    }

    public function addSubtask(): void
    {
        $label = trim($this->newSubtask);

        if ($label === '' || ! $this->selectedProject) {
            return;
        }

        $position = $this->selectedProject->tasks()->max('position');

        $this->selectedProject->tasks()->create([
            'user_id' => $this->selectedProject->user_id,
            'created_by_user_id' => Auth::id(),
            'title' => $label,
            'position' => $position === null ? 0 : $position + 1,
        ]);

        $this->newSubtask = '';
    }

    public function toggleSubtask(int $taskId): void
    {
        $task = Auth::user()->tasks()->where('project_id', $this->selectedProjectId)->findOrFail($taskId);
        $task->completed_at = $task->isCompleted() ? null : now();
        $task->save();
    }
};
?>

<div class="flex min-h-full">
    <aside class="w-[320px] shrink-0 border-r border-[var(--color-border)] px-6 py-8">
        <h2 class="mb-4 text-sm font-bold text-[var(--color-text)]">Projets &amp; routines</h2>
        <ul class="space-y-1.5">
            @foreach ($this->projects as $project)
                <li>
                    <button
                        type="button"
                        wire:click="select({{ $project->id }})"
                        @class([
                            'flex w-full items-center gap-3 rounded-xl px-4 py-3 text-left text-sm font-semibold transition-colors',
                            'btn-ink shadow-sm' => $this->selectedProject?->id === $project->id,
                            'text-[var(--color-text)] hover:bg-[var(--color-surface-2)]' => $this->selectedProject?->id !== $project->id,
                        ])
                    >
                        <span class="flex-1">{{ $project->name }}</span>
                        <span @class([
                            'text-xs font-bold',
                            'text-white/70' => $this->selectedProject?->id === $project->id,
                            'text-[var(--color-text-2)]' => $this->selectedProject?->id !== $project->id,
                        ])>{{ $project->progressPercent() }}%</span>
                    </button>
                </li>
            @endforeach
            <li>
                @if ($addingProject)
                    <form wire:submit="addProject" class="flex items-center gap-2 rounded-xl border-2 border-dashed border-[var(--color-border)] px-4 py-3">
                        <input
                            type="text"
                            wire:model="newProjectName"
                            placeholder="Nom du projet..."
                            class="w-full bg-transparent text-sm font-semibold text-[var(--color-text)] placeholder:font-normal placeholder:text-[var(--color-text-2)] focus:outline-none"
                        >
                    </form>
                @else
                    <button
                        type="button"
                        wire:click="startAddingProject"
                        class="w-full rounded-xl border-2 border-dashed border-[var(--color-border)] px-4 py-3 text-left text-sm font-semibold text-[var(--color-text-2)]"
                    >
                        + nouveau projet
                    </button>
                @endif
            </li>
        </ul>
    </aside>

    <section class="flex-1 px-10 py-8">
        @if ($this->selectedProject)
            <h1 class="text-2xl font-extrabold tracking-tight text-[var(--color-text)]">{{ $this->selectedProject->name }}</h1>

            <div class="mt-4 flex gap-2">
                @foreach (['nom' => 'Nom', 'decoupage' => 'Decoupage', 'frequence' => 'Frequence'] as $key => $label)
                    <button
                        type="button"
                        wire:click="goToStep('{{ $key }}')"
                        @class([
                            'rounded-full px-4 py-1.5 text-sm font-bold',
                            'btn-ink' => $step === $key,
                            'bg-[var(--color-surface-2)] text-[var(--color-text-2)]' => $step !== $key,
                        ])
                    >
                        {{ $label }}
                    </button>
                @endforeach
            </div>

            @if ($step === 'decoupage')
                <div class="mt-6">
                    <div class="h-2.5 w-full max-w-xl rounded-full bg-[var(--color-surface-2)]">
                        <div class="h-2.5 rounded-full bg-[var(--color-success)]" style="width: {{ $this->selectedProject->progressPercent() }}%"></div>
                    </div>
                    <p class="mt-2 text-xs font-semibold text-[var(--color-text-2)]">{{ $this->selectedProject->progressPercent() }}% des etapes faites</p>

                    <ul class="mt-6 max-w-xl space-y-2">
                        @forelse ($this->selectedProject->tasks as $task)
                            <li>
                                <button
                                    type="button"
                                    wire:click="toggleSubtask({{ $task->id }})"
                                    class="flex w-full items-center gap-3 rounded-xl px-4 py-3 text-left {{ $task->isCompleted() ? 'bg-[var(--color-success-soft)]' : 'bg-[var(--color-surface)] shadow-sm' }}"
                                >
                                    <span class="flex h-5 w-5 shrink-0 items-center justify-center rounded-full border-2 text-[10px] font-black {{ $task->isCompleted() ? 'border-[var(--color-success)] bg-[var(--color-success)] text-white' : 'border-[var(--color-text-2)] text-transparent' }}">✓</span>
                                    <span class="text-sm font-semibold {{ $task->isCompleted() ? 'text-[var(--color-success)] line-through' : 'text-[var(--color-text)]' }}">{{ $task->title }}</span>
                                    @if ($task->is_ai_suggested)
                                        <span class="ml-auto rounded-full bg-[var(--color-ai-soft)] px-2.5 py-1 text-[10px] font-extrabold uppercase text-[var(--color-ai)]">ia</span>
                                    @endif
                                </button>
                            </li>
                        @empty
                            <li class="text-sm text-[var(--color-text-2)]">Pas encore d'etape - ajoute la premiere ci-dessous.</li>
                        @endforelse
                    </ul>

                    <form wire:submit="addSubtask" class="mt-2 flex max-w-xl items-center gap-3 rounded-xl border-2 border-dashed border-[var(--color-border)] px-4 py-3">
                        <span class="text-[var(--color-text-2)]">+</span>
                        <input
                            type="text"
                            wire:model="newSubtask"
                            placeholder="Ajouter une etape..."
                            class="w-full bg-transparent text-sm font-semibold text-[var(--color-text)] placeholder:font-normal placeholder:text-[var(--color-text-2)] focus:outline-none"
                        >
                    </form>
                </div>
            @elseif ($step === 'nom')
                <form wire:submit="renameProject" class="mt-6 flex max-w-xl items-center gap-3">
                    <input
                        type="text"
                        wire:model="projectName"
                        class="w-full rounded-xl border border-[var(--color-border)] bg-[var(--color-surface)] px-4 py-3 text-sm font-semibold text-[var(--color-text)]"
                    >
                    <button type="submit" class="btn-ink shrink-0 rounded-xl px-4 py-3 text-sm font-bold">Enregistrer</button>
                </form>
            @else
                <p class="mt-6 text-sm text-[var(--color-text-2)]">Frequence a definir - pas encore branche sur un vrai systeme de recurrence.</p>
            @endif
        @else
            <h1 class="text-2xl font-extrabold tracking-tight text-[var(--color-text)]">Projets &amp; routines</h1>
            <p class="mt-2 text-sm text-[var(--color-text-2)]">Cree un premier projet pour commencer a le decouper en etapes.</p>
        @endif
    </section>
</div>
