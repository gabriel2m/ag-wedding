<?php

namespace App\Providers;

use App\Contracts\View\Composer;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewComposersServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // ...
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $namespace = str(static::namespace());

        foreach (File::allFiles(config('view.composers')) as $file) {
            $class = $namespace
                ->append("/{$file->getRelativePathname()}")
                ->before('.php')
                ->replace('/', '\\')
                ->toString();

            if (! is_subclass_of($class, Composer::class)) {
                continue;
            }

            View::composer($class::views(), $class);
        }
    }

    public static function namespace(): string
    {
        $dir = str(config('view.composers'));

        foreach (data_get(json_decode(File::get(base_path('composer.json')), true), 'autoload.psr-4', []) as $to => $from) {
            if (str_starts_with($dir, base_path($from))) {
                $dir = $dir->replaceFirst($from, $to);
                break;
            }
        }

        return $dir->after(base_path('/'))->replace('/', '\\')->toString();
    }
}
