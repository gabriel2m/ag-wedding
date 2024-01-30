<?php

namespace App\Console\Commands;

use App\Http\Middleware\RoutePermission;
use Facades\Spatie\Permission\Models\Permission;
use Illuminate\Console\Command;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route as RouteFacade;

class CreatePermissionsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:permissions:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create permissions from route names';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $new_permissions = collect(RouteFacade::getRoutes()->getRoutes())
            ->filter(fn (Route $route) => in_array(RoutePermission::class, $route->middleware()))
            ->map(fn (Route $route) => $route->getName());

        foreach ($new_permissions as $permission) {
            while (str_contains($permission, '.')) {
                $permission = str($permission)->beforeLast('.');
                $new_permissions->add("$permission.*");
            }
        }

        $current_permissions = DB::table(Permission::getTable())->pluck('name');

        $new_permissions = $new_permissions
            ->unique()
            ->filter(fn (string $permission) => ! $current_permissions->contains($permission))
            ->whenEmpty(
                fn () => $this->outputComponents()->info('Already up to date'),
                fn () => $this->outputComponents()->info('Creating permissions')
            )
            ->each(function ($permission) {
                Permission::create(['name' => $permission]);
                $this->outputComponents()->twoColumnDetail($permission, '<fg=green;options=bold>CREATED</>');
            });

    }
}
