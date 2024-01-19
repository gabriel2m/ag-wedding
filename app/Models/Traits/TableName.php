<?php

namespace App\Models\Traits;

trait TableName
{
    /**
     * Get the table associated with the model.
     */
    public static function table(): string
    {
        return (new static)->getTable();
    }
}
