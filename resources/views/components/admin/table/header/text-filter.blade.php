@props(['filter', 'label'])

<x-admin.table.header :attributes="$attributes">
    <div class="flex">
        <span class="mt-auto">
            @lang($label)
        </span>
        <div class="relative ml-2">
            <x-text-input
                :name="sprintf('filter[%s]', $filter)"
                :value="request()->input('filter.' . $filter)"
                class="peer border-0 border-b border-slate-400/50 pb-0 pl-1 pr-8 text-slate-700 filter focus:border-slate-400/50 focus:ring-0"
                type="text"
            />
            <x-heroicon-o-magnifying-glass class="duration-400 absolute bottom-1 right-3 h-4 text-slate-400/50 transition peer-focus:text-slate-500" />
            <div class="absolute bottom-0 block w-full scale-x-0 border-b border-gray-400 transition-transform duration-300 peer-focus:scale-x-100 peer-focus:border-slate-500">
            </div>
        </div>
    </div>
</x-admin.table.header>
