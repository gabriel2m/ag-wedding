<?php

namespace App\View\Composers\Admin\Gifts;

use App\Contracts\View\Composer;
use App\Http\QueryBuilder\AllowedFilter;
use App\Models\Gift;
use App\View\Composers\NamesakeView;
use Illuminate\View\View;
use Spatie\QueryBuilder\QueryBuilder;

class Page implements Composer
{
    use NamesakeView;

    public function compose(View $view): void
    {
        $view->gifts = QueryBuilder::for(Gift::class)
            ->allowedFilters(AllowedFilter::partial('name'))
            ->defaultSort('name')
            ->cursorPaginate()
            ->withQueryString();
    }
}
