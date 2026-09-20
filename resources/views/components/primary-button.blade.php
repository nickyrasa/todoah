<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn-ink inline-flex items-center rounded-full px-5 py-2.5 text-sm font-semibold shadow-sm focus:outline-none focus:ring-2 focus:ring-[var(--color-ink)] focus:ring-offset-2']) }}>
    {{ $slot }}
</button>
