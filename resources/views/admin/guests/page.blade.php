@if ($guests->isEmpty())
    <x-admin.table.row>
        <x-admin.table.cell
            class="text-center"
            colspan="all"
        >
            @lang('No guests found')
        </x-admin.table.cell>
    </x-admin.table.row>
@else
    @foreach ($guests as $guest)
        <x-admin.table.row
            ::class="{
                'bg-gray-200': response == {{ WeddingGuestResponse::PENDING->value }},
                'bg-green-200': response == {{ WeddingGuestResponse::WILL->value }},
                'bg-red-200': response == {{ WeddingGuestResponse::WILL_NOT->value }},
            }"
            x-data="{ response: {{ $guest->response->value }} }"
        >
            <x-admin.table.cell :font_light="false">
                {{ $guest->name }}
            </x-admin.table.cell>
            <x-admin.table.cell>
                {{ $guest->phone_number }}
            </x-admin.table.cell>
            <x-admin.table.cell class="flex">
                <select
                    :class="{
                        'border-gray-400': response == {{ WeddingGuestResponse::PENDING->value }},
                        'border-green-400': response == {{ WeddingGuestResponse::WILL->value }},
                        'border-red-400': response == {{ WeddingGuestResponse::WILL_NOT->value }},
                    }"
                    class="m-auto rounded bg-inherit py-1 text-sm"
                    hx-disabled-elt="this"
                    hx-headers-merge="{{ '{ "X-HX-Only-Alert": true }' }}"
                    hx-on:htmx:config-request="event.detail.parameters.response = event.detail.elt.value"
                    hx-post="{{ route('admin.guests.answer', $guest) }}"
                    hx-swap="none"
                    hx-target="this"
                    x-on:change="response = $el.value"
                >
                    @foreach (WeddingGuestResponse::cases() as $response)
                        <option
                            @selected($response == $guest->response)
                            value="{{ $response->value }}"
                        >
                            {{ $response->label() }}
                        </option>
                    @endforeach
                </select>
            </x-admin.table.cell>
            @can('admin.guests.edit')
                <x-admin.table.cell>
                    <x-admin.page-link
                        :params="$guest"
                        route="admin.guests.edit"
                        title="Edit"
                    >
                        <div class="rounded p-1 hover:bg-indigo-700 hover:text-white">
                            <x-heroicon-o-pencil-square class="h-4" />
                        </div>
                    </x-admin.page-link>
                </x-admin.table.cell>
            @endcan
            @can('admin.guests.destroy')
                <x-admin.table.cell>
                    <button
                        class="rounded p-1 hover:bg-indigo-700 hover:text-white"
                        hx-confirm="{{ trans('Are you sure?') }}"
                        hx-delete="{{ route('admin.guests.destroy', $guest) }}"
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
            @if ($guests->hasMorePages())
                <div class="min-h-8 text-slate-500/80">
                    <div class="content flex w-full">
                        <button
                            class="m-auto h-min rounded border border-slate-200 px-6 py-1.5 text-xs uppercase text-slate-700 hover:bg-neutral-500 hover:bg-opacity-10"
                            hx-disabled-elt="this"
                            hx-get="{{ $guests->nextPageUrl() }}"
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
