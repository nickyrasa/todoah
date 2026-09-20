@props(['value'])

<label {{ $attributes->merge(['class' => 'block text-sm font-medium text-[var(--color-text)] mb-1']) }}>
    {{ $value ?? $slot }}
</label>
