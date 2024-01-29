<?php

if (! function_exists('title')) {
    /**
     * Converts sections to page title
     *
     * @param  string[]  $sections
     */
    function title(array $sections): string
    {
        return collect($sections)
            ->map(fn ($val) => trans($val))
            ->add(config('app.name'))
            ->implode(' | ');
    }
}
