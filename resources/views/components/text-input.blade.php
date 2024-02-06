<input {{ $attributes->merge([
    'value' => old($attributes['name']),
    'type' => 'text',
]) }}>
