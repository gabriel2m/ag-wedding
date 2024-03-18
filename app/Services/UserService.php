<?php

namespace App\Services;

use App\Contracts\Services\UserService as UserServiceContract;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class UserService implements UserServiceContract
{
    public function create(array $data): User
    {
        return DB::transaction(function () use ($data) {
            return tap(User::create(array_merge($data, ['password' => Str::password(8)])), function (User $user) use ($data) {
                $user->givePermissionTo($data['permissions']);
                Password::sendResetLink(Arr::only($data, 'email'));
            });
        });
    }

    public function update(User $user, array $data): bool
    {
        return DB::transaction(function () use ($user, $data) {
            $user->syncPermissions($data['permissions']);

            return $user
                ->fill($data)
                ->save();
        });
    }
}
