<p class="text-sm leading-5">
    @lang('Showing')
    {{ $paginator->perPage() * ($paginator->currentPage() - 1) + $paginator->count() }}
    @lang('of')
    {{ $paginator->total() }}
</p>
