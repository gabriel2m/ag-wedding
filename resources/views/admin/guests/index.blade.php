<x-admin.content title="Guest List">
    <form
        action="{{ route('admin.guests.index') }}"
        hx-boost="true"
        hx-headers-merge="{{ '{"X-HX-Page": true}' }}"
        hx-target="find tbody"
        hx-trigger="input changed delay:400ms from:[name^='filter']"
    >
        <x-admin.table>
            <x-slot:head>
                <x-admin.table.header.text-filter
                    class="w-96"
                    filter="name"
                />
                <x-admin.table.header.text-filter
                    class="w-1"
                    filter="phone_number"
                />
                <x-admin.table.header class="flex">
                    <x-label
                        class="mt-0.5"
                        for="filter[response]"
                        text="validation.attributes.response"
                    />
                    <select
                        class="ml-2 rounded border-gray-200 py-1 text-sm text-slate-700"
                        name="filter[response]"
                    >
                        <option></option>
                        @foreach (WeddingGuestResponse::cases() as $response)
                            <option
                                @selected("$response->value" == request()->input('filter.response'))
                                value="{{ $response->value }}"
                            >
                                {{ $response->label() }}
                            </option>
                        @endforeach
                    </select>
                </x-admin.table.header>
            </x-slot>
            <x-slot:body
                class="divide-slate-50"
            >
                @include('admin.guests.page')
            </x-slot>
        </x-admin.table>
    </form>
</x-admin.content>
