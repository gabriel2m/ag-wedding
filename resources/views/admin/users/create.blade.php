<x-admin.content
    :breadcrumb="[
        [
            'route' => 'admin.users.index',
            'label' => 'Users',
        ],
        [
            'label' => 'Add',
        ],
    ]"
    :title="['Add', 'Users']"
    content_title="Add user"
>
    <form
        class="space-y-5"
        hx-indicator="find [type='submit']"
        hx-post="{{ route('admin.users.store') }}"
        hx-target="#inputs"
        x-data="{ disable: false }"
        x-on:htmx:after-request="disable = false"
        x-on:htmx:before-request="disable = true"
    >
        <div
            class="space-y-5"
            id="inputs"
        >
            @include('admin.users.inputs')
        </div>
        <hr />
        <div class="flex justify-between space-x-3 md:justify-end">
            <x-admin.page-link
                class="flex items-center gap-1 rounded-md px-3 py-1.5 text-sm font-semibold text-slate-500/80 hover:bg-gray-200 hover:text-gray-900"
                route="admin.users.index"
                type="button"
            >
                <x-heroicon-o-x-mark class="h-6" />
                @lang('Cancel')
            </x-admin.page-link>
            <button
                class="group flex items-center gap-1 rounded-md px-3 py-1.5 text-sm font-semibold text-indigo-600 hover:bg-indigo-700 hover:text-white"
                type="submit"
            >
                <x-heroicon-o-check class="h-5 group-[.htmx-request]:hidden" />
                <div class="htmx-indicator h-5 w-5">
                    <x-admin.loading class="h-4 w-4" />
                </div>
                @lang('Save')
            </button>
        </div>
    </form>
</x-admin.content>
