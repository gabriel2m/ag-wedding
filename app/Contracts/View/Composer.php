<?php

namespace App\Contracts\View;

use Illuminate\View\View;

interface Composer
{
    /**
     * List of views that this composer will be registered
     *
     * @return string[]
     */
    public static function views(): array;

    /**
     * Bind data to the view.
     */
    public function compose(View $view): void;
}
