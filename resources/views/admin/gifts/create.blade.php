<x-admin.content
    :breadcrumb="[
        [
            'route' => 'admin.gifts.index',
            'label' => 'Gift list',
        ],
        [
            'label' => 'Add',
        ],
    ]"
    :title="['Add', 'Gift list']"
    content_title="Add gift"
>
    <x-admin.gifts.form hx-post="{{ route('admin.gifts.store') }}" />
</x-admin.content>
