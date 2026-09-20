<?php

use App\Enums\DayPart;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;

new #[Layout('layouts.app')] class extends Component
{
    public string $newTask = '';

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
    public function nextTaskId(): ?int
    {
        foreach ($this->tasksByPeriod as $tasks) {
            $next = $tasks->first(fn (Task $task) => ! $task->isCompleted());

            if ($next) {
                return $next->id;
            }
        }

        return null;
    }

    public function addTask(): void
    {
        $label = trim($this->newTask);

        if ($label === '') {
            return;
        }

        $position = Auth::user()->tasks()
            ->scheduledOn(today())
            ->where('day_part', DayPart::Morning)
            ->max('position');

        Auth::user()->tasks()->create([
            'created_by_user_id' => Auth::id(),
            'title' => $label,
            'day_part' => DayPart::Morning,
            'scheduled_for' => today(),
            'position' => $position === null ? 0 : $position + 1,
        ]);

        $this->newTask = '';
    }

    public function toggle(int $taskId): void
    {
        $task = Auth::user()->tasks()->findOrFail($taskId);
        $task->completed_at = $task->isCompleted() ? null : now();
        $task->save();
    }
};
?>

@php
    $periodLabels = [
        'morning' => 'Matin',
        'afternoon' => 'Apres-midi',
        'evening' => 'Soir',
        'anytime' => 'A un moment de la journee',
    ];
    $periodIcons = [
        'morning' => '<path d="M12 3v3M4.2 6.2l2 2M19.8 6.2l-2 2M3 13h2M19 13h2"/><path d="M6 13a6 6 0 0 1 12 0"/><path d="M4 17h16"/>',
        'afternoon' => '<circle cx="12" cy="12" r="4.2"/><path d="M12 3v2M12 19v2M4.9 4.9l1.4 1.4M17.7 17.7l1.4 1.4M3 12h2M19 12h2M4.9 19.1l1.4-1.4M17.7 6.3l1.4-1.4"/>',
        'evening' => '<path d="M20 14.3A7.9 7.9 0 0 1 9.7 4a8 8 0 1 0 10.3 10.3Z"/>',
        'anytime' => '<path d="M8 6h12M8 12h12M8 18h12"/><circle cx="3.5" cy="6" r="1.3"/><circle cx="3.5" cy="12" r="1.3"/><circle cx="3.5" cy="18" r="1.3"/>',
    ];
@endphp

<div class="mx-auto max-w-3xl px-8 py-10">
    <h1 class="text-3xl font-extrabold tracking-tight text-[var(--color-text)]">Aujourd'hui</h1>
    <p class="mt-1 text-sm text-[var(--color-text-2)]">{{ now()->locale('fr')->isoFormat('dddd D MMMM') }}</p>

    <form wire:submit="addTask" class="mt-6 flex items-center gap-3 rounded-2xl border border-[var(--color-border)] bg-[var(--color-surface)] py-2 pl-2 pr-5 shadow-sm">
        <span class="btn-ink flex h-9 w-9 shrink-0 items-center justify-center rounded-full text-base leading-none">+</span>
        <input
            type="text"
            wire:model="newTask"
            placeholder="Ajouter une tache..."
            class="w-full bg-transparent text-sm font-medium text-[var(--color-text)] placeholder:text-[var(--color-text-2)] focus:outline-none"
        >
    </form>

    <div class="mt-10 space-y-8">
        @foreach ($this->tasksByPeriod as $period => $tasks)
            @continue($tasks->isEmpty())
            <section>
                <h2 class="mb-3 flex items-center gap-2 text-sm font-bold text-[var(--color-text)]">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4 text-[var(--color-text-2)]">
                        {!! $periodIcons[$period] !!}
                    </svg>
                    {{ $periodLabels[$period] }}
                </h2>
                <ul class="space-y-2">
                    @foreach ($tasks as $task)
                        @php $isNext = ! $task->isCompleted() && $task->id === $this->nextTaskId; @endphp
                        <li>
                            <button
                                type="button"
                                wire:click="toggle({{ $task->id }})"
                                @class([
                                    'flex w-full items-center gap-3 rounded-xl px-4 py-3.5 text-left transition-colors',
                                    'btn-ink shadow-md' => $isNext,
                                    'bg-[var(--color-success-soft)]' => $task->isCompleted(),
                                    'bg-[var(--color-surface)] shadow-sm' => ! $task->isCompleted() && ! $isNext,
                                ])
                            >
                                <span @class([
                                    'flex h-5 w-5 shrink-0 items-center justify-center rounded-full border-2 text-[10px] font-black',
                                    'border-[var(--color-success)] bg-[var(--color-success)] text-white' => $task->isCompleted(),
                                    'border-white/40 text-transparent' => $isNext,
                                    'border-[var(--color-text-2)] text-transparent' => ! $task->isCompleted() && ! $isNext,
                                ])>✓</span>
                                <span @class([
                                    'min-w-0 flex-1 truncate text-sm font-semibold',
                                    'text-[var(--color-success)] line-through' => $task->isCompleted(),
                                    'text-white' => $isNext,
                                    'text-[var(--color-text)]' => ! $task->isCompleted() && ! $isNext,
                                ])>
                                    {{ $task->title }}
                                </span>
                                <span class="ml-auto flex shrink-0 items-center gap-2">
                                    @if ($task->project)
                                        <span @class([
                                            'rounded-full px-2.5 py-1 text-[11px] font-bold',
                                            'bg-white/15 text-white' => $isNext,
                                            'bg-[var(--color-surface-2)] text-[var(--color-text-2)]' => ! $isNext,
                                        ])>
                                            {{ $task->project->name }}
                                        </span>
                                    @endif
                                    @if ($task->isCompleted())
                                        <span class="rounded-full bg-[var(--color-reward-soft)] px-2.5 py-1 text-[11px] font-extrabold text-[var(--color-reward)]">+10 XP</span>
                                    @elseif ($isNext)
                                        <span class="rounded-full bg-white/15 px-2.5 py-1 text-[11px] font-bold text-white">à faire</span>
                                    @endif
                                </span>
                            </button>
                        </li>
                    @endforeach
                </ul>
            </section>
        @endforeach
    </div>
</div>
