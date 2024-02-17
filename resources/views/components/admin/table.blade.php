@props(['body' => null])

<div class="overflow-x-auto">
    <table {{ $attributes->class(['min-w-full table-fixed text-left']) }}>
        <thead class="border-b text-slate-500/80">
            <x-admin.table.row>
                {{ $head }}
            </x-admin.table.row>
        </thead>
        <tbody class="divide-y">
            {{ $body }}
        </tbody>
    </table>
</div>
