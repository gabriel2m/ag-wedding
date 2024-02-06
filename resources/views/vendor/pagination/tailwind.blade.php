<p class="text-sm leading-5 text-gray-700 dark:text-gray-400">
    @lang('Showing')
    {{ $paginator->perPage() * ($paginator->currentPage() - 1) + $paginator->count() }}
    @lang('of')
    {{ $paginator->total() }}
</p>
