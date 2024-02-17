<?php

namespace App\Providers;

use App\Http\Middleware\IsHtmx;
use App\Http\Middleware\RoutePermission;
use Barryvdh\Debugbar\LaravelDebugbar;
use Illuminate\Contracts\Http\Kernel;
use Illuminate\Database\Connectors\PostgresConnector;
use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View as ViewFacade;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Illuminate\View\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind('db.connector.pgsql', function () {
            return new class extends PostgresConnector
            {
                protected function getDsn(array $config)
                {
                    $dsn = parent::getDsn($config);

                    if (! config('database.connections.pgsql.add_endpoint_id')) {
                        return $dsn;
                    }

                    return $dsn.';options=endpoint='.Str::before($config['host'], '.');
                }
            };
        });

        $this->app->extend(LaravelDebugbar::class, function (LaravelDebugbar $debugbar) {
            $debugbar->getJavascriptRenderer()->setEnableJqueryNoConflict(false);

            return $debugbar;
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Vite::macro('image', fn (string $image) => Vite::asset("resources/images/{$image}"));

        View::macro('withAlert', function (array $alert) {
            ViewFacade::share('alert', $alert);

            return $this;
        });

        if (config('database.log_queries')) {
            DB::listen(function (QueryExecuted $query) {
                Log::debug("query: $query->sql");
            });
        }

        app(Kernel::class)
            ->appendToMiddlewarePriority(RoutePermission::class)
            ->appendToMiddlewarePriority(IsHtmx::class);
    }
}
