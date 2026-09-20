<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'TODOAH' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="min-h-screen font-sans antialiased" x-data="{ journalOpen: false }">
    <div class="flex min-h-screen">
        <nav class="flex w-[72px] shrink-0 flex-col items-center gap-6 border-r border-[var(--color-border)] bg-[var(--color-surface)] py-6">
            <a href="{{ route('dashboard') }}" title="Aujourd'hui"
               class="flex h-10 w-10 items-center justify-center rounded-full {{ request()->routeIs('dashboard') ? 'bg-[var(--color-accent-soft)] text-[var(--color-accent)]' : 'text-[var(--color-text-2)]' }}">
                <span class="text-xs">Auj.</span>
            </a>
            <a href="{{ route('routines') }}" title="Routines &amp; Projets"
               class="flex h-10 w-10 items-center justify-center rounded-full {{ request()->routeIs('routines') ? 'bg-[var(--color-accent-soft)] text-[var(--color-accent)]' : 'text-[var(--color-text-2)]' }}">
                <span class="text-xs">Proj.</span>
            </a>
            <a href="{{ route('groupe') }}" title="Groupe"
               class="flex h-10 w-10 items-center justify-center rounded-full {{ request()->routeIs('groupe') ? 'bg-[var(--color-accent-soft)] text-[var(--color-accent)]' : 'text-[var(--color-text-2)]' }}">
                <span class="text-xs">Grp.</span>
            </a>
        </nav>

        <main class="relative flex-1 bg-[var(--color-bg)]">
            {{ $slot }}

            <x-avatar-widget />
        </main>
    </div>

    @livewireScripts
    @vite('resources/js/avatar.js')
</body>
</html>
