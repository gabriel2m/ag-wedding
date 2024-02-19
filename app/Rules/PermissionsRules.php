<?php

namespace App\Rules;

use Illuminate\Support\Collection;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Permission;

trait PermissionsRules
{
    protected function permissionsRules(): Collection
    {
        return collect([
            'permissions' => [
                'array',
            ],
            'permissions.*' => [
                'integer',
                Rule::exists(Permission::class, 'id'),
            ],
        ]);
    }
}
