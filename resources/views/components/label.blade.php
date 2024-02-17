@props(['text' => null])

@php
    $text ??= "validation.attributes.{$attributes['for']}";
@endphp

<label {{ $attributes->class(['block']) }}>
    {{ trans_cap($text) }}
</label>
