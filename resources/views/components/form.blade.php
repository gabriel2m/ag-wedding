@php
    $method = $attributes['method'];
    $csrf = !in_array($method, ['GET', null]);
    $spoof = $csrf && $method != 'POST';

    if ($spoof) {
        $attributes['method'] = 'POST';
    }
@endphp

<form {{ $attributes }}>
    @if ($csrf)
        @csrf
    @endif

    @if ($spoof)
        @method($method)
    @endif

    {{ $slot }}
</form>
