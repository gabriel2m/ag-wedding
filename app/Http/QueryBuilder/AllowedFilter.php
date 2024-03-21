<?php

namespace App\Http\QueryBuilder;

use App\Http\QueryBuilder\Filters\FiltersPartial;

class AllowedFilter extends \Spatie\QueryBuilder\AllowedFilter
{
    public static function partial(string $name, $internalName = null, bool $addRelationConstraint = true, ?string $arrayValueDelimiter = null): self
    {
        static::setFilterArrayValueDelimiter($arrayValueDelimiter);

        return new static($name, new FiltersPartial($addRelationConstraint), $internalName);
    }
}
