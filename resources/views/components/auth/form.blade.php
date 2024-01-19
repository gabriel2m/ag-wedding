<x-form :attributes="$attributes->merge([
    'class' => 'space-y-6',
    'method' => 'POST',
])">
    {{ $slot }}
</x-form>
