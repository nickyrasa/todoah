<?php

use Livewire\Component;
use Livewire\Attributes\Layout;

new #[Layout('layouts.app')] class extends Component
{
    // Structure d'exemple - le vrai modele Projet/Routine/SousTache reste a concevoir.
    public array $projects = [
        'anniversaire' => ['label' => 'Anniversaire de Mia', 'progress' => 20],
        'demenagement' => ['label' => 'Demenagement', 'progress' => 60],
        'cpam' => ['label' => 'Dossier CPAM', 'progress' => 0],
    ];

    public string $selected = 'demenagement';

    public string $step = 'decoupage';

    public array $subtasks = [
        ['label' => 'Reserver le camion', 'done' => true, 'suggested' => true],
        ['label' => 'Trier les cartons', 'done' => true, 'suggested' => true],
        ['label' => "Changer d'adresse EDF", 'done' => false, 'suggested' => false],
    ];

    public string $newSubtask = '';

    public function select(string $key): void
    {
        $this->selected = $key;
    }

    public function goToStep(string $step): void
    {
        $this->step = $step;
    }

    public function addSubtask(): void
    {
        $label = trim($this->newSubtask);

        if ($label === '') {
            return;
        }

        $this->subtasks[] = ['label' => $label, 'done' => false, 'suggested' => false];
        $this->newSubtask = '';
    }
};
?>

<div class="flex min-h-full">
    <aside class="w-[320px] shrink-0 border-r border-[var(--color-border)] px-6 py-8">
        <h2 class="mb-4 text-sm font-bold text-[var(--color-text)]">Projets &amp; routines</h2>
        <ul class="space-y-1.5">
            @foreach ($projects as $key => $project)
                <li>
                    <button
                        type="button"
                        wire:click="select('{{ $key }}')"
                        @class([
                            'flex w-full items-center gap-3 rounded-xl px-4 py-3 text-left text-sm font-semibold transition-colors',
                            'btn-ink shadow-sm' => $selected === $key,
                            'text-[var(--color-text)] hover:bg-[var(--color-surface-2)]' => $selected !== $key,
                        ])
                    >
                        <span class="flex-1">{{ $project['label'] }}</span>
                        <span @class([
                            'text-xs font-bold',
                            'text-white/70' => $selected === $key,
                            'text-[var(--color-text-2)]' => $selected !== $key,
                        ])>{{ $project['progress'] }}%</span>
                    </button>
                </li>
            @endforeach
            <li>
                <button type="button" class="w-full rounded-xl border-2 border-dashed border-[var(--color-border)] px-4 py-3 text-left text-sm font-semibold text-[var(--color-text-2)]">
                    + nouveau projet
                </button>
            </li>
        </ul>
    </aside>

    <section class="flex-1 px-10 py-8">
        <h1 class="text-2xl font-extrabold tracking-tight text-[var(--color-text)]">{{ $projects[$selected]['label'] }}</h1>

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
                    <div class="h-2.5 rounded-full bg-[var(--color-success)]" style="width: {{ $projects[$selected]['progress'] }}%"></div>
                </div>
                <p class="mt-2 text-xs font-semibold text-[var(--color-text-2)]">{{ $projects[$selected]['progress'] }}% des etapes faites</p>

                <ul class="mt-6 max-w-xl space-y-2">
                    @foreach ($subtasks as $subtask)
                        <li class="flex items-center gap-3 rounded-xl px-4 py-3 {{ $subtask['done'] ? 'bg-[var(--color-success-soft)]' : 'bg-[var(--color-surface)] shadow-sm' }}">
                            <span class="flex h-5 w-5 shrink-0 items-center justify-center rounded-full border-2 text-[10px] font-black {{ $subtask['done'] ? 'border-[var(--color-success)] bg-[var(--color-success)] text-white' : 'border-[var(--color-text-2)] text-transparent' }}">✓</span>
                            <span class="text-sm font-semibold {{ $subtask['done'] ? 'text-[var(--color-success)] line-through' : 'text-[var(--color-text)]' }}">{{ $subtask['label'] }}</span>
                            @if ($subtask['suggested'])
                                <span class="ml-auto rounded-full bg-[var(--color-ai-soft)] px-2.5 py-1 text-[10px] font-extrabold uppercase text-[var(--color-ai)]">ia</span>
                            @endif
                        </li>
                    @endforeach
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
            <div class="mt-6 max-w-xl">
                <input
                    type="text"
                    value="{{ $projects[$selected]['label'] }}"
                    class="w-full rounded-xl border border-[var(--color-border)] bg-[var(--color-surface)] px-4 py-3 text-sm font-semibold text-[var(--color-text)]"
                >
            </div>
        @else
            <p class="mt-6 text-sm text-[var(--color-text-2)]">Frequence a definir - pas encore branche sur un vrai systeme de recurrence.</p>
        @endif
    </section>
</div>
