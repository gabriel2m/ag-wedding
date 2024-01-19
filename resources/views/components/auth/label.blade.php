@props(['margin' => true])

<x-label :attributes="$attributes->class(['block text-sm font-medium leading-6 text-gray-900', 'mb-2' => $margin])">
    {{ $slot }}
</x-label>
