<?php

use Illuminate\Support\Arr;

if (! function_exists('title')) {
    /**
     * Converts sections to page title
     *
     * @param  string[]|string  $sections
     */
    function title(array|string $sections): string
    {
        $title = array_map(
            fn ($val) => trans($val),
            Arr::wrap($sections)
        );

        $title[] = config('app.name');

        return implode(' | ', $title);
    }
}
