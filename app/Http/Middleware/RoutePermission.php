<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Spatie\Permission\Middleware\PermissionMiddleware;
use Symfony\Component\HttpFoundation\Response;

class RoutePermission
{
    public function handle(Request $request, Closure $next): Response
    {
        return app(PermissionMiddleware::class)->handle($request, $next, $request->route()->getName());
    }
}
