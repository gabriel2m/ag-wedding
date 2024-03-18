@props(['route', 'params' => []])

@can($route)
    <a
        {{ $attributes->merge([
            'hx-boost' => 'true',
            'hx-disabled-elt' => 'this',
            'hx-indicator' => 'main',
            'hx-swap' => 'outerHTML',
            'hx-target' => '#content',
        ]) }}
        href="{{ route($route, $params) }}"
    >
        {{ $slot }}
    </a>
@endcan
