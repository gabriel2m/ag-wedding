@props(['filter', 'label' => null])

@php
    $name = "filter[$filter]";
    $label ??= "validation.attributes.$filter";
@endphp

<x-admin.table.header :attributes="$attributes">
    <div class="flex">
        <x-label
            :for="$name"
            :text="$label"
        />
        <div class="relative ml-2 flex items-center border-b">
            <x-text-input
                :name="$name"
                :value="request()->input('filter.' . $filter)"
                class="peer border-0 px-1 py-0 leading-none text-slate-700 filter focus:ring-0"
                type="text"
            />
            <x-heroicon-o-magnifying-glass class="duration-400 mr-1 h-4 text-slate-400/50 transition peer-focus:text-slate-500" />
            <div class="absolute bottom-0 block w-full scale-x-0 border-b border-gray-400 transition-transform duration-300 peer-focus:scale-x-100 peer-focus:border-slate-500">
            </div>
        </div>
    </div>
</x-admin.table.header>
