@props(['message', 'type' => 'info'])

<div class="relative">
    <div class="absolute right-0 z-50">
        <div
            {{ $attributes->class([
                'border-l-4 max-w-sm fixed -translate-x-full transition duration-200',
                match ($type) {
                    'success' => 'border-green-600 bg-green-200 p-4 hover:border-green-500',
                    'error' => 'border-red-600 bg-red-200 p-4 hover:border-red-500',
                    'warning' => 'border-yellow-600 bg-yellow-200 p-4 hover:border-yellow-500',
                    'info' => 'border-blue-600 bg-blue-200 p-4 hover:border-blue-500',
                },
            ]) }}
            x-cloak
            x-data="{ open: false }"
            x-init="setTimeout(() => open = true, 0);"
            x-show="open"
            x-transition:enter="opacity-0 scale-90 !-translate-x-0"
            x-transition:leave="opacity-0 scale-90 !-translate-x-0"
        >
            <div @class([
                'flex justify-between gap-2',
                match ($type) {
                    'success' => 'text-green-900',
                    'error' => 'text-red-900',
                    'warning' => 'text-yellow-900',
                    'info' => 'text-blue-900',
                },
            ])>
                {{ $message }}
                <button
                    class="mb-auto mt-0.5"
                    type="button"
                    x-on:click="open = false"
                >
                    <x-heroicon-o-x-mark class="h-5" />
                </button>
            </div>
        </div>
    </div>
</div>
