<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="{{ asset('favicon.png') }}">

    @php
        $title[] = config('app.name');
    @endphp
    <title>{{ implode(' | ', $title) }}</title>

    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">

    @vite('resources/css/app.css')
    @stack('styles')
</head>

<body hx-headers='{"X-CSRF-TOKEN": "{{ csrf_token() }}"}'>
    @vite('resources/js/app.js')
    @stack('scripts')
</body>

</html>
