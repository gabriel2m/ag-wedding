<?php

namespace App\Rules;

use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

trait UserRules
{
    protected function userRules(): Collection
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
        ]);
    }
}
