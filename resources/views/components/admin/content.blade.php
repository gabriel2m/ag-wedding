@props([
    'title' => null,
    'content_title' => null,
])
@php
    $content_title ??= $title;
@endphp

<x-title :title="$title" />

<div
    class="flex h-full flex-col"
    id="content"
>
    @if ($slot->isNotEmpty())
        @if ($content_title)
            <x-h3
                :text="$content_title"
                class="mb-1"
            />
        @endif

        <div class="grow rounded-lg border border-slate-950/20 bg-white p-6">
            {{ $slot }}
        </div>
    @endif
</div>
