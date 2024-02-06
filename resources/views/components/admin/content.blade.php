@props([
    'title' => null,
    'content_title' => null,
])
@php
    $content_title ??= $title;
@endphp

<x-title :title="$title" />

<div
    class="content flex h-full flex-col transition duration-300"
    id="content"
>
    @if ($slot->isNotEmpty())
        @if ($content_title)
            <h3 class="mb-1">
                @lang($content_title)
            </h3>
        @endif

        <div class="grow rounded-lg border border-slate-950/20 bg-white px-10 py-6">
            {{ $slot }}
        </div>
    @endif
</div>
