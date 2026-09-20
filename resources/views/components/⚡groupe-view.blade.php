<?php

use Livewire\Component;
use Livewire\Attributes\Layout;

new #[Layout('layouts.app')] class extends Component
{
    // Groupe et flux d'activite d'exemple - le modele Groupe/Membre/Invitation
    // reste a concevoir (voir CLAUDE.md : famille/proches, assignation possible).
    public array $members = ['Toi', 'Lea', 'Sam'];

    public array $activity = [
        'Lea a termine : ranger le salon',
        'Sam a assigne : sortir les poubelles a toi',
        'Toi as termine : preparer le sac',
    ];
};
?>

<div class="mx-auto max-w-3xl px-4 py-6 sm:px-8 sm:py-10">
    <div class="flex flex-col gap-4 pr-16 sm:flex-row sm:items-start sm:justify-between sm:pr-0">
        <div>
            <h1 class="text-2xl font-extrabold tracking-tight text-[var(--color-text)] sm:text-3xl">Groupe</h1>
            <p class="mt-1 text-sm text-[var(--color-text-2)]">Famille - {{ count($members) }} membres</p>
        </div>
        <button type="button" class="btn-ink w-fit rounded-full px-4 py-2 text-sm font-bold shadow-sm">
            + assigner
        </button>
    </div>

    <div class="mt-8 flex flex-wrap gap-6">
        @foreach ($members as $i => $member)
            <div class="flex flex-col items-center gap-2">
                <span class="flex h-12 w-12 items-center justify-center rounded-full bg-[var(--color-surface-2)] text-sm font-extrabold text-[var(--color-text)]">
                    {{ mb_substr($member, 0, 1) }}
                </span>
                <span class="text-xs font-semibold text-[var(--color-text-2)]">{{ $member }}</span>
            </div>
        @endforeach
        <div class="flex flex-col items-center gap-2">
            <span class="flex h-12 w-12 items-center justify-center rounded-full border-2 border-dashed border-[var(--color-border)] text-[var(--color-text-2)]">+</span>
            <span class="text-xs font-semibold text-[var(--color-text-2)]">Inviter</span>
        </div>
    </div>

    <h2 class="mt-10 mb-3 text-sm font-bold text-[var(--color-text)]">Activite recente</h2>
    <ul class="space-y-2">
        @foreach ($activity as $item)
            <li class="flex items-center gap-3 rounded-xl bg-[var(--color-surface)] px-4 py-3 shadow-sm">
                <span class="h-2 w-2 rounded-full bg-[var(--color-success)]"></span>
                <span class="text-sm font-semibold text-[var(--color-text)]">{{ $item }}</span>
            </li>
        @endforeach
    </ul>
</div>
