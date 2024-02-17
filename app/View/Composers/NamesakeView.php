<?php

namespace App\View\Composers;

use App\Providers\ViewComposersServiceProvider;

trait NamesakeView
{
    public static function views(): array
    {
        return [
            str(__CLASS__)
                ->after(ViewComposersServiceProvider::namespace().'\\')
                ->lower()
                ->replace('\\', '.'),
        ];
    }
}
