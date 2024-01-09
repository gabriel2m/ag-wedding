<?php

namespace App\Providers;

use Illuminate\Database\Connectors\PostgresConnector;
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
        //
    }
}
