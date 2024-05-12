<?php

namespace App\View\Composers\Admin\Gifts;

use App\Contracts\View\Composer;
use App\Models\Gift;
use App\View\Composers\NamesakeView;
use Illuminate\View\View;

class Inputs implements Composer
{
    use NamesakeView;

    public function compose(View $view): void
    {
        $view->gift = (request()->route('gift') ?? new Gift)->fill(request()->post());
    }
}
