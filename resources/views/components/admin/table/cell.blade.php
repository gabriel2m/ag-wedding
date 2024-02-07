@props(['font_light' => true])

<td {{ $attributes->class(['px-5 py-3', 'font-light' => $font_light]) }}>
    {{ $slot }}
</td>
