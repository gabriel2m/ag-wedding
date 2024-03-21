<x-admin.content
    :breadcrumb="[
        [
            'route' => 'admin.guests.index',
            'label' => 'Guest list',
        ],
        [
            'label' => 'Edit',
        ],
    ]"
    :content_title="$guest->name"
    :title="['Edit', $guest->name, 'Guest list']"
>
    <x-admin.guests.form hx-put="{{ route('admin.guests.update', $guest) }}" />
</x-admin.content>
