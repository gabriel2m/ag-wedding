<x-admin.content
    :breadcrumb="[
        [
            'route' => 'admin.gifts.index',
            'label' => 'Gift list',
        ],
        [
            'label' => 'Edit',
        ],
    ]"
    :content_title="$gift->name"
    :title="['Edit', $gift->name, 'Gift list']"
>
    <x-admin.gifts.form hx-put="{{ route('admin.gifts.update', $gift) }}" />
</x-admin.content>
