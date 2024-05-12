@if ($gifts->isEmpty())
    <x-admin.table.row>
        <x-admin.table.cell
            class="text-center"
            colspan="all"
        >
            @lang('No gifts found')
        </x-admin.table.cell>
    </x-admin.table.row>
@else
    @foreach ($gifts as $gift)
        <x-admin.table.row>
            <x-admin.table.cell :font_light="false">
                {{ $gift->name }}
            </x-admin.table.cell>
            @can('admin.gifts.edit')
                <x-admin.table.cell>
                    <x-admin.page-link
                        :params="$gift"
                        class="block w-min"
                        route="admin.gifts.edit"
                        title="Edit"
                    >
                        <div class="rounded p-1 hover:bg-indigo-700 hover:text-white">
                            <x-heroicon-o-pencil-square class="h-4" />
                        </div>
                    </x-admin.page-link>
                </x-admin.table.cell>
            @endcan
            @can('admin.gifts.destroy')
                <x-admin.table.cell>
                    <button
                        class="rounded p-1 hover:bg-indigo-700 hover:text-white"
                        hx-confirm="{{ trans('Are you sure?') }}"
                        hx-delete="{{ route('admin.gifts.destroy', $gift) }}"
                        hx-disabled-elt="this"
                        hx-target="closest tr"
                        title="{{ trans('Remove') }}"
                        type="button"
                    >
                        <x-heroicon-o-trash class="content h-4" />
                        <x-admin.loading class="h-4 w-4" />
                    </button>
                </x-admin.table.cell>
            @endcan
        </x-admin.table.row>
    @endforeach
    <x-admin.table.row>
        <x-admin.table.cell
            :font_light="false"
            colspan="all"
        >
            @if ($gifts->hasMorePages())
                <div class="min-h-8 text-slate-500/80">
                    <div class="content flex w-full">
                        <button
                            class="m-auto h-min rounded border border-slate-200 px-6 py-1.5 text-xs uppercase text-slate-700 hover:bg-neutral-500 hover:bg-opacity-10"
                            hx-disabled-elt="this"
                            hx-get="{{ $gifts->nextPageUrl() }}"
                            hx-indicator="closest tr"
                            hx-swap="outerHTML"
                            hx-target="closest tr"
                            type="button"
                        >
                            @lang('Load more')
                        </button>
                    </div>
                    <x-admin.loading class="h-5" />
                </div>
            @endif
        </x-admin.table.cell>
    </x-admin.table.row>
@endempty
