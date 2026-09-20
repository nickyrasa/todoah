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
        <nav class="flex w-[76px] shrink-0 flex-col items-center gap-1 border-r border-[var(--color-border)] py-5">
            <div class="btn-ink mb-6 flex h-9 w-9 items-center justify-center rounded-2xl text-sm font-extrabold">T</div>

            @php
                $navItems = [
                    ['route' => 'dashboard', 'label' => "Aujourd'hui", 'icon' => 'sun'],
                    ['route' => 'groupe', 'label' => 'Groupe', 'icon' => 'people'],
                ];
                $icons = [
                    'sun' => '<circle cx="12" cy="12" r="4.2"/><path d="M12 2.5v2.4M12 19.1v2.4M4.6 4.6l1.7 1.7M17.7 17.7l1.7 1.7M2.5 12h2.4M19.1 12h2.4M4.6 19.4l1.7-1.7M17.7 6.3l1.7-1.7"/>',
                    'people' => '<circle cx="8.5" cy="8" r="3"/><circle cx="16" cy="9" r="2.4"/><path d="M2.8 19c.6-3 2.7-4.6 5.7-4.6s5.1 1.6 5.7 4.6"/><path d="M14.6 14.9c2.3.2 3.9 1.7 4.4 4.1"/>',
                    'user' => '<circle cx="12" cy="8.2" r="3.4"/><path d="M5 19.4c.8-3.4 3-5.1 7-5.1s6.2 1.7 7 5.1"/>',
                    'exit' => '<path d="M9 4H5.6C4.7 4 4 4.7 4 5.6v12.8c0 .9.7 1.6 1.6 1.6H9"/><path d="M14 8l4 4-4 4"/><path d="M18 12H9"/>',
                ];
            @endphp

            @foreach ($navItems as $item)
                @php $active = request()->routeIs($item['route']); @endphp
                <a href="{{ route($item['route']) }}" title="{{ $item['label'] }}"
                   class="flex h-11 w-11 items-center justify-center rounded-full transition-colors {{ $active ? 'bg-[var(--color-ink)] text-[var(--color-ink-text)]' : 'text-[var(--color-text-2)] hover:bg-[var(--color-surface-2)] hover:text-[var(--color-text)]' }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5">
                        {!! $icons[$item['icon']] !!}
                    </svg>
                </a>
            @endforeach

            <div class="mt-auto flex flex-col items-center gap-1">
                <a href="{{ route('profile.edit') }}" title="Mon profil"
                   class="flex h-11 w-11 items-center justify-center rounded-full {{ request()->routeIs('profile.edit') ? 'bg-[var(--color-ink)] text-[var(--color-ink-text)]' : 'text-[var(--color-text-2)] hover:bg-[var(--color-surface-2)] hover:text-[var(--color-text)]' }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5">
                        {!! $icons['user'] !!}
                    </svg>
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" title="Se déconnecter" class="flex h-11 w-11 items-center justify-center rounded-full text-[var(--color-text-2)] hover:bg-[var(--color-surface-2)] hover:text-[var(--color-text)]">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5">
                            {!! $icons['exit'] !!}
                        </svg>
                    </button>
                </form>
            </div>
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
