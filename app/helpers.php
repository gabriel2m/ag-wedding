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

if (! function_exists('trans_cap')) {
    /**
     * Translate the given message and capitalize the first char.
     */
    function trans_cap(?string $key = null, array $replace = [], ?string $locale = null): ?string
    {
        return ucfirst(trans(...func_get_args()));
    }
}
