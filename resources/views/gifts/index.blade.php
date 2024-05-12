@foreach ($gifts as $gift)
    <div class="flex h-[28rem] w-72 flex-col overflow-hidden rounded-xl border border-slate-500/10 shadow-lg">
        <img
            class="h-56 w-full"
            src="{{ $gift->image }}"
        />
        <p class="p-8 text-xl">
            {{ $gift->name }}
        </p>
        <div class="mb-6 mt-auto px-8">
            <h5 class="font-semibold">
                @reais($gift->price)
            </h5>
            <button class="mt-5 rounded-full bg-green-950/95 px-6 py-2 font-medium text-white">
                Presentear
            </button>
        </div>
    </div>
@endforeach
@if ($gifts->hasMorePages())
    <div class="content flex w-full justify-center">
        <button
            class="m-auto h-min rounded border border-slate-200 px-6 py-1.5 text-xs uppercase text-slate-700 hover:bg-neutral-500 hover:bg-opacity-10"
            hx-disabled-elt="this"
            hx-get="{{ $gifts->nextPageUrl() }}"
            hx-swap="outerHTML"
            hx-target="closest div"
            type="button"
        >
            @lang('Load more')
            <x-admin.loading class="h-5" />
        </button>
    </div>
@endif
