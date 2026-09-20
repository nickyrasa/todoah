<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'TODOAH') }}</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-h-screen font-sans antialiased">
        <div class="flex min-h-screen flex-col items-center justify-center bg-[var(--color-bg)] px-6 py-12">
            <a href="/" class="mb-6 text-lg font-medium text-[var(--color-text)]">TODOAH</a>

            <div class="w-full max-w-md rounded-2xl border border-[var(--color-border)] bg-[var(--color-surface)] px-6 py-6">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
