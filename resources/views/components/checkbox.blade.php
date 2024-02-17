@props(['label' => null, 'cap' => true])

@php
    $text = $label?->toHtml() ?: "validation.attributes.{$attributes['name']}";
    $attributes = $attributes->merge([
        'id' => $attributes['name'],
        'type' => 'checkbox',
    ]);
@endphp

<label
    {{ $label?->attributes->class(['flex items-center']) }}
    for="{{ $attributes['id'] }}"
>
    <input {{ $attributes }}>
    @if ($cap)
        {{ trans_cap($text) }}
    @else
        @lang($text)
    @endif
</label>
