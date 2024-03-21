<?php

namespace App\View\Composers\Admin\Guests;

use App\Contracts\View\Composer;
use App\Http\QueryBuilder\AllowedFilter;
use App\Models\WeddingGuest;
use App\View\Composers\NamesakeView;
use Illuminate\View\View;
use Spatie\QueryBuilder\QueryBuilder;

class Page implements Composer
{
    use NamesakeView;

    public function compose(View $view): void
    {
        $view->guests = QueryBuilder::for(WeddingGuest::class)
            ->allowedFilters(
                AllowedFilter::partial('name'),
                'phone_number',
                AllowedFilter::exact('response')
            )
            ->defaultSort('name')
            ->select('id', 'name', 'phone_number', 'response')
            ->cursorPaginate()
            ->withQueryString();
    }
}
