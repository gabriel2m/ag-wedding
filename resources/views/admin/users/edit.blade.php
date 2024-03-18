<x-admin.content
    :breadcrumb="[
        [
            'route' => 'admin.users.index',
            'label' => 'Users',
        ],
        [
            'label' => 'Edit',
        ],
    ]"
    :content_title="$user->name"
    :title="['Edit', $user->name, 'Users']"
>
    <x-admin.users.form hx-put="{{ route('admin.users.update', $user) }}" />
</x-admin.content>
