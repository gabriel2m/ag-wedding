<!DOCTYPE html>
<html
    class="h-full bg-white"
    lang="{{ str_replace('_', '-', app()->getLocale()) }}"
>

<head>
    <meta charset="utf-8">
    <meta
        content="width=device-width, initial-scale=1.0"
        name="viewport"
    >
    <link
        href="{{ Vite::image('favicon.png') }}"
        rel="shortcut icon"
        type="image/png"
    >

    <x-title :title="$title ?? null" />

    <link
        href="https://rsms.me/inter/inter.css"
        rel="stylesheet"
    >

    @vite('resources/css/app.css')
    @stack('styles')
</head>

<body
    class="h-full text-slate-800"
    hx-headers="{{ json_encode([
        'X-CSRF-TOKEN' => csrf_token(),
        'Accept' => 'text/html',
        'X-Requested-With' => 'XMLHttpRequest',
    ]) }}"
>
    @yield('content')

    @vite('resources/js/app.js')
    @stack('scripts')
</body>

</html>
