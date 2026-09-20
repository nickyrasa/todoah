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
        <h2 class="mb-4 text-sm font-medium text-[var(--color-text)]">Projets &amp; routines</h2>
        <ul class="space-y-2">
            @foreach ($projects as $key => $project)
                <li>
                    <button
                        type="button"
                        wire:click="select('{{ $key }}')"
                        class="w-full rounded-lg px-4 py-3 text-left text-sm {{ $selected === $key ? 'bg-[var(--color-accent-soft)] text-[var(--color-accent)]' : 'bg-[var(--color-surface-2)] text-[var(--color-text)]' }}"
                    >
                        {{ $project['label'] }}
                    </button>
                </li>
            @endforeach
            <li>
                <button type="button" class="w-full rounded-lg border border-dashed border-[var(--color-border)] px-4 py-3 text-left text-sm text-[var(--color-text-2)]">
                    + nouveau projet
                </button>
            </li>
        </ul>
    </aside>

    <section class="flex-1 px-10 py-8">
        <h1 class="text-xl font-medium text-[var(--color-text)]">{{ $projects[$selected]['label'] }}</h1>

        <div class="mt-4 flex gap-2">
            @foreach (['nom' => 'Nom', 'decoupage' => 'Decoupage', 'frequence' => 'Frequence'] as $key => $label)
                <button
                    type="button"
                    wire:click="goToStep('{{ $key }}')"
                    class="rounded-full px-4 py-1.5 text-sm {{ $step === $key ? 'bg-[var(--color-accent-soft)] text-[var(--color-accent)]' : 'bg-[var(--color-surface-2)] text-[var(--color-text-2)]' }}"
                >
                    {{ $label }}
                </button>
            @endforeach
        </div>

        @if ($step === 'decoupage')
            <div class="mt-6">
                <div class="h-2.5 w-full max-w-xl rounded-full bg-[var(--color-surface-2)]">
                    <div class="h-2.5 rounded-full bg-[var(--color-accent)]" style="width: {{ $projects[$selected]['progress'] }}%"></div>
                </div>
                <p class="mt-2 text-xs text-[var(--color-text-2)]">{{ $projects[$selected]['progress'] }}% des etapes faites</p>

                <ul class="mt-6 max-w-xl space-y-2">
                    @foreach ($subtasks as $subtask)
                        <li class="flex items-center gap-3 rounded-lg border border-[var(--color-border)] bg-[var(--color-surface)] px-4 py-3">
                            <span class="flex h-4 w-4 shrink-0 items-center justify-center rounded-full border {{ $subtask['done'] ? 'border-[var(--color-accent)] bg-[var(--color-accent)]' : 'border-[var(--color-text-2)]' }}"></span>
                            <span class="text-sm text-[var(--color-text)]">{{ $subtask['label'] }}</span>
                            @if ($subtask['suggested'])
                                <span class="ml-auto rounded-full bg-[var(--color-accent-soft)] px-2 py-0.5 text-[10px] font-medium uppercase text-[var(--color-accent)]">ia</span>
                            @endif
                        </li>
                    @endforeach
                </ul>

                <form wire:submit="addSubtask" class="mt-2 flex max-w-xl items-center gap-3 rounded-lg border border-dashed border-[var(--color-border)] px-4 py-3">
                    <span class="text-[var(--color-text-2)]">+</span>
                    <input
                        type="text"
                        wire:model="newSubtask"
                        placeholder="Ajouter une etape..."
                        class="w-full bg-transparent text-sm text-[var(--color-text)] placeholder:text-[var(--color-text-2)] focus:outline-none"
                    >
                </form>
            </div>
        @elseif ($step === 'nom')
            <div class="mt-6 max-w-xl">
                <input
                    type="text"
                    value="{{ $projects[$selected]['label'] }}"
                    class="w-full rounded-lg border border-[var(--color-border)] bg-[var(--color-surface)] px-4 py-3 text-sm text-[var(--color-text)]"
                >
            </div>
        @else
            <p class="mt-6 text-sm text-[var(--color-text-2)]">Frequence a definir - pas encore branche sur un vrai systeme de recurrence.</p>
        @endif
    </section>
</div>
