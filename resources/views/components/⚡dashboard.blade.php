<?php

use Livewire\Component;
use Livewire\Attributes\Layout;

new #[Layout('layouts.app')] class extends Component
{
    // Donnees d'exemple, en memoire pour le moment - le schema de tache reel
    // (persistance, recurrence, rappels) reste a concevoir avec l'utilisateur.
    public array $sections = [
        'Matin' => [
            ['label' => 'Preparer le sac', 'done' => false],
            ['label' => 'Prendre le traitement', 'done' => false],
        ],
        'Apres-midi' => [
            ['label' => 'Appeler la banque', 'done' => false],
        ],
        'Soir' => [
            ['label' => 'Routine du soir', 'done' => false],
        ],
    ];

    public string $newTask = '';

    public function addTask(): void
    {
        $label = trim($this->newTask);

        if ($label === '') {
            return;
        }

        $this->sections['Matin'][] = ['label' => $label, 'done' => false];
        $this->newTask = '';
    }

    public function toggle(string $period, int $index): void
    {
        $this->sections[$period][$index]['done'] = ! $this->sections[$period][$index]['done'];
    }
};
?>

<div class="mx-auto max-w-3xl px-8 py-10">
    <h1 class="text-2xl font-medium text-[var(--color-text)]">Aujourd'hui</h1>
    <p class="mt-1 text-sm text-[var(--color-text-2)]">{{ now()->locale('fr')->isoFormat('dddd D MMMM') }}</p>

    <form wire:submit="addTask" class="mt-6 flex items-center gap-3 rounded-xl border border-[var(--color-accent)] bg-[var(--color-accent-soft)] px-4 py-3">
        <span class="text-[var(--color-accent)]">+</span>
        <input
            type="text"
            wire:model="newTask"
            placeholder="Ajouter une tache..."
            class="w-full bg-transparent text-sm text-[var(--color-text)] placeholder:text-[var(--color-text-2)] focus:outline-none"
        >
    </form>

    <div class="mt-10 space-y-8">
        @foreach ($sections as $period => $tasks)
            <section>
                <h2 class="mb-3 text-sm font-medium text-[var(--color-text)]">{{ $period }}</h2>
                <ul class="space-y-2">
                    @foreach ($tasks as $index => $task)
                        <li>
                            <button
                                type="button"
                                wire:click="toggle('{{ $period }}', {{ $index }})"
                                class="flex w-full items-center gap-3 rounded-lg border border-[var(--color-border)] bg-[var(--color-surface)] px-4 py-3 text-left"
                            >
                                <span class="flex h-4 w-4 shrink-0 items-center justify-center rounded-full border {{ $task['done'] ? 'border-[var(--color-accent)] bg-[var(--color-accent)]' : 'border-[var(--color-text-2)]' }}"></span>
                                <span class="text-sm {{ $task['done'] ? 'text-[var(--color-text-2)] line-through' : 'text-[var(--color-text)]' }}">
                                    {{ $task['label'] }}
                                </span>
                            </button>
                        </li>
                    @endforeach
                </ul>
            </section>
        @endforeach
    </div>
</div>
