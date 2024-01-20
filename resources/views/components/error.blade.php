@props(['name'])

@error($name)
    <small {{ $attributes->class(['text-red-500']) }}>
        {{ $message }}
    </small>
@enderror
