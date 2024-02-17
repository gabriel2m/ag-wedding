@props([
    'title' => null,
    'content_title' => null,
    'breadcrumb' => [],
])
@php
    $content_title ??= $title;
@endphp

<x-title :title="$title" />

<div
    class="content flex h-full flex-col transition duration-300"
    id="content"
>
    <nav class="mb-6 flex h-6 items-center gap-1 font-light text-slate-500/90">
        @foreach ($breadcrumb as $item)
            @if (!$loop->last)
                <x-admin.page-link
                    :params="$item['params'] ?? []"
                    :route="$item['route']"
                    class="hover:text-sky-700"
                >
                    @lang($item['label'])
                </x-admin.page-link>
                <x-heroicon-o-chevron-right class="h-4" />
            @else
                <span class="text-slate-800">
                    @lang($item['label'])
                </span>
            @endif
        @endforeach
    </nav>

    @if ($slot->isNotEmpty())
        @if ($content_title)
            <h3 class="mb-1">
                @lang($content_title)
            </h3>
        @endif

        <div class="grow rounded-lg border border-slate-950/20 bg-white px-5 md:px-10 py-3 md:py-6">
            {{ $slot }}
        </div>
    @endif
</div>
