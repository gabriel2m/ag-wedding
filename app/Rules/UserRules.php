<?php

namespace App\Rules;

use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Spatie\Permission\Models\Permission;

trait UserRules
{
    protected function userRules(string ...$only): array
    {
        return collect([
            'name' => [
                'required',
                'string',
                'max:255',
            ],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique' => Rule::unique(User::class),
            ],
            'password' => [
                'required',
                'string',
                Password::min(5),
                'confirmed',
            ],
            'current_password' => [
                'required',
                'string',
                'current_password:web',
            ],
            'permissions' => [
                'array',
            ],
            'permissions.*' => [
                'integer',
                Rule::exists(Permission::class, 'id'),
            ],
        ])->only($only ?: null)->toArray();
    }
}
