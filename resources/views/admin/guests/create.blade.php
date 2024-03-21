<x-admin.content
    :breadcrumb="[
        [
            'route' => 'admin.guests.index',
            'label' => 'Guest list',
        ],
        [
            'label' => 'Add',
        ],
    ]"
    :title="['Add', 'Guest list']"
    content_title="Add guest"
>
    <x-admin.guests.form hx-post="{{ route('admin.guests.store') }}" />
</x-admin.content>
