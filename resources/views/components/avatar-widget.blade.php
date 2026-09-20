@php
    // Donnees d'exemple - le vrai historique de progression viendra de la base
    // une fois le schema (niveaux, jalons) concu avec l'utilisateur.
    $milestones = [
        ['label' => 'Premiere routine creee', 'when' => 'il y a 3 semaines', 'current' => false],
        ['label' => 'Niveau 2 atteint', 'when' => 'il y a 2 semaines', 'current' => false],
        ['label' => 'Badge momentum (7 jours de suite)', 'when' => 'il y a 1 semaine', 'current' => false],
        ['label' => 'Niveau 4, aujourd\'hui', 'when' => 'continue comme ca', 'current' => true],
    ];
@endphp

<button
    type="button"
    @click="journalOpen = !journalOpen"
    aria-label="Voir ma progression"
    class="absolute right-6 top-6 flex h-12 w-12 items-center justify-center rounded-full bg-[var(--color-accent-soft)] ring-1 ring-[var(--color-accent)]"
>
    <canvas id="avatar-canvas" width="48" height="48" class="pointer-events-none rounded-full"></canvas>
</button>

<div
    x-show="journalOpen"
    x-transition:enter="transition ease-out duration-200"
    x-transition:enter-start="opacity-0 translate-x-2"
    x-transition:enter-end="opacity-100 translate-x-0"
    x-transition:leave="transition ease-in duration-150"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    @click.outside="journalOpen = false"
    class="absolute right-6 top-24 w-[360px] rounded-2xl border border-[var(--color-border)] bg-[var(--color-surface)] p-5 shadow-sm"
    style="display: none;"
>
    <h2 class="mb-4 text-base font-medium text-[var(--color-text)]">Mon parcours</h2>
    <ol class="relative ml-3 space-y-5 border-l border-[var(--color-border)] pl-5">
        @foreach ($milestones as $milestone)
            <li class="relative">
                <span class="absolute -left-[25px] top-1 h-2.5 w-2.5 rounded-full {{ $milestone['current'] ? 'bg-[var(--color-accent)]' : 'bg-[var(--color-surface-2)] ring-1 ring-[var(--color-border)]' }}"></span>
                <p class="text-sm font-medium text-[var(--color-text)]">{{ $milestone['label'] }}</p>
                <p class="text-xs text-[var(--color-text-2)]">{{ $milestone['when'] }}</p>
            </li>
        @endforeach
    </ol>
</div>
