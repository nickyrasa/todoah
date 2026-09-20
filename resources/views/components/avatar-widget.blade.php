@php
    // Donnees d'exemple - le vrai historique de progression viendra de la base
    // une fois les composants Livewire rebranches sur le schema (Lot 5).
    $level = 4;
    $xpPercent = 60;
    $milestones = [
        ['label' => 'Premiere routine creee', 'when' => 'il y a 3 semaines', 'kind' => 'default'],
        ['label' => 'Niveau 2 atteint', 'when' => 'il y a 2 semaines', 'kind' => 'reward'],
        ['label' => 'Badge momentum (7 jours de suite)', 'when' => 'il y a 1 semaine', 'kind' => 'reward'],
        ['label' => 'Niveau 4, aujourd\'hui', 'when' => 'continue comme ca', 'kind' => 'current'],
    ];
@endphp

<button
    type="button"
    @click="journalOpen = !journalOpen"
    aria-label="Voir ma progression"
    class="absolute right-6 top-6 flex h-14 w-14 items-center justify-center rounded-full"
    style="background: conic-gradient(var(--color-success) {{ $xpPercent }}%, var(--color-border) 0)"
>
    <span class="flex h-11 w-11 items-center justify-center rounded-full bg-[var(--color-surface)]">
        <canvas id="avatar-canvas" width="40" height="40" class="pointer-events-none rounded-full"></canvas>
    </span>
    <span class="absolute -bottom-1 -right-1 flex h-5 w-5 items-center justify-center rounded-full bg-[var(--color-ink)] text-[10px] font-extrabold text-[var(--color-ink-text)]">{{ $level }}</span>
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
    class="absolute right-6 top-24 w-[360px] rounded-3xl border border-[var(--color-border)] bg-[var(--color-surface)] p-5 shadow-sm"
    style="display: none;"
>
    <div class="mb-4 flex items-center justify-between">
        <h2 class="text-base font-extrabold text-[var(--color-text)]">Mon parcours</h2>
        <span class="rounded-full bg-[var(--color-success-soft)] px-3 py-1 text-xs font-bold text-[var(--color-success)]">Niveau {{ $level }}</span>
    </div>
    <ol class="relative ml-3 space-y-5 border-l-2 border-[var(--color-border)] pl-5">
        @foreach ($milestones as $milestone)
            <li class="relative">
                <span @class([
                    'absolute -left-[27px] top-1 h-3 w-3 rounded-full',
                    'bg-[var(--color-ink)]' => $milestone['kind'] === 'current',
                    'bg-[var(--color-success)]' => $milestone['kind'] === 'reward',
                    'bg-[var(--color-surface-2)] ring-2 ring-[var(--color-border)]' => $milestone['kind'] === 'default',
                ])></span>
                <p class="text-sm font-semibold text-[var(--color-text)]">{{ $milestone['label'] }}</p>
                <p class="text-xs text-[var(--color-text-2)]">{{ $milestone['when'] }}</p>
            </li>
        @endforeach
    </ol>
</div>
