@props(['route', 'params' => []])

@can($route)
    <a
        {{ $attributes->merge([
            'hx-boost' => 'true',
            'hx-disabled-elt' => 'this',
            'hx-indicator' => 'main',
            'hx-swap' => 'outerHTML',
            'hx-target' => '#content',
            'hx-headers-merge' => '{"X-PJAX": true}',
        ]) }}
        href="{{ route($route, $params) }}"
    >
        {{ $slot }}
    </a>
@endcan
