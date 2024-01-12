<?php

namespace App\Providers;

use Illuminate\Database\Connectors\PostgresConnector;
use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

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
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Vite::macro('image', fn (string $image) => Vite::asset("resources/images/{$image}"));

        if (config('database.log_queries')) {
            DB::listen(function (QueryExecuted $query) {
                Log::debug("query: $query->sql");
            });
        }
    }
}
