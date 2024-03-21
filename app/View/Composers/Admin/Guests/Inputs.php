<?php

namespace App\View\Composers\Admin\Guests;

use App\Contracts\View\Composer;
use App\Models\WeddingGuest;
use App\View\Composers\NamesakeView;
use Illuminate\View\View;

class Inputs implements Composer
{
    use NamesakeView;

    public function compose(View $view): void
    {
        $view->guest = (request()->route('guest') ?? new WeddingGuest)->fill(request()->post());
    }
}
