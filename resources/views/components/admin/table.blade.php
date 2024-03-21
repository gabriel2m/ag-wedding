<div class="overflow-x-auto">
    <table {{ $attributes->class(['min-w-full table-fixed text-left']) }}>
        <thead class="border-b text-slate-500/80">
            <x-admin.table.row>
                {{ $head }}
            </x-admin.table.row>
        </thead>
        <tbody {{ $body->attributes->class(['divide-y content']) }}>
            {{ $body }}
        </tbody>
        <tfoot>
            <x-admin.table.row>
                <x-admin.table.cell colspan="all">
                    <x-admin.loading class="m-auto h-5 text-gray-400" />
                </x-admin.table.cell>
            </x-admin.table.row>
        </tfoot>
    </table>
</div>
