<?php

namespace App\View\Composers\Admin\Users;

use App\Contracts\View\Composer;
use App\Http\QueryBuilder\AllowedFilter;
use App\Models\User;
use App\View\Composers\NamesakeView;
use Illuminate\View\View;
use Spatie\QueryBuilder\QueryBuilder;

class Page implements Composer
{
    use NamesakeView;

    public function compose(View $view): void
    {
        $view->users = QueryBuilder::for(User::class)
            ->allowedFilters(
                AllowedFilter::partial('name'),
                'email'
            )
            ->defaultSort(['name', 'email'])
            ->select('name', 'email', 'id')
            ->cursorPaginate()
            ->withQueryString();
    }
}
