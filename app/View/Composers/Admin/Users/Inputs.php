<?php

namespace App\View\Composers\Admin\Users;

use App\Contracts\View\Composer;
use App\Models\User;
use App\View\Composers\NamesakeView;
use Illuminate\View\View;
use Spatie\Permission\Models\Permission;

class Inputs implements Composer
{
    use NamesakeView;

    public function compose(View $view): void
    {
        $view->user ??= new User;
        $view->user->fill(request()->input());

        $permissions = Permission::query()->select('id', 'name')->orderBy('name')->get();

        $view->permissions = $permissions
            ->keyBy('id')
            ->map(function (Permission $permission) use ($permissions) {
                $permission->active = in_array($permission->id, request()->input('permissions', []));

                if (! str_contains($permission->name, '*')) {
                    $permission->permissions = [];

                    return $permission;
                }

                $permission->permissions = $permissions
                    ->except([$permission->id])
                    ->filter(
                        fn (Permission $sub_permission) => str_starts_with($sub_permission->name, str_replace('*', '', $permission->name))
                    )
                    ->map(fn (Permission $sub_permission) => $sub_permission->id)
                    ->values();

                return $permission;
            });
    }
}
