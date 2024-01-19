<input
    {{ $attributes->merge([
        'id' => $attributes['name'],
        'value' => old($attributes['name']),
        'type' => 'text',
    ]) }}>
