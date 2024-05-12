@props(['value' => null])

<textarea {{ $attributes->merge([
    'id' => $attributes['name'],
]) }}>{{ old($attributes['name']) ?? $value }}</textarea>
