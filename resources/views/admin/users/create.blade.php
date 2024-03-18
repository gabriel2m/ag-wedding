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
    <x-admin.users.form hx-post="{{ route('admin.users.store') }}" />
</x-admin.content>
