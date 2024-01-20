@props(['message'])

@if ($message)
    <div {{ $attributes->class(['my-4 w-full border-l-4 border-blue-400 bg-blue-100 p-4 hover:border-blue-500']) }}>
        {{ $message }}
    </div>
@endif
