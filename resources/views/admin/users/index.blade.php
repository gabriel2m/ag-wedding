<x-admin.content title="Users">
    <x-slot:heading>
        <x-admin.page-link
            class="mb-1 ml-auto mt-auto flex items-center gap-1 rounded border border-gray-400 px-5 py-1 text-xs font-semibold uppercase hover:border-transparent hover:bg-indigo-700 hover:text-white"
            route="admin.users.create"
        >
            <x-heroicon-o-plus-circle class="h-5" />
            @lang('Add')
        </x-admin.page-link>
    </x-slot>

    <form
        action="{{ route('admin.users.index') }}"
        hx-boost="true"
        hx-headers-merge="{{ '{"X-HX-Page": true}' }}"
        hx-target="find tbody"
        hx-trigger="input changed delay:400ms from:[name]"
    >
        <x-admin.table id="users-table">
            <x-slot:head>
                <x-admin.table.header.text-filter
                    class="w-96"
                    filter="name"
                />
                <x-admin.table.header.text-filter filter="email" />
            </x-slot>
            <x-slot:body>
                @include('admin.users.page')
            </x-slot>
        </x-admin.table>
    </form>
</x-admin.content>
