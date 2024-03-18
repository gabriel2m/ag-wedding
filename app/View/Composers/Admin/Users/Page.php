<?php

namespace App\View\Composers\Admin\Users;

use App\Contracts\View\Composer;
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
            ->allowedFilters(['name', 'email'])
            ->defaultSort(['name', 'email'])
            ->select('name', 'email', 'id')
            ->paginate()
            ->withQueryString();
    }
}
