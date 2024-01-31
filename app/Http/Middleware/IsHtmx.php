<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsHtmx
{
    public function handle(Request $request, Closure $next, string $layout): Response
    {
        if ($request->isMethod('GET') && ! $request->header('HX-Request', false)) {
            return response(view($layout));
        }

        return $next($request);
    }

    /**
     * Specify the layout for the middleware.
     */
    public static function layout(string $layout): string
    {
        return static::class.":$layout";
    }
}
