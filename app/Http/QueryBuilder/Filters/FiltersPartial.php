<?php

namespace App\Http\QueryBuilder\Filters;

use Illuminate\Support\Facades\DB;

class FiltersPartial extends \Spatie\QueryBuilder\Filters\FiltersPartial
{
    protected function getWhereRawParameters($value, string $property): array
    {
        return parent::getWhereRawParameters(
            $value,
            DB::getDriverName() == 'pgsql' ? "unaccent($property)" : $property
        );
    }
}
