<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAsset
{
    public function handle(Request $request, Closure $next): Response
    {
        if (File::isFile(public_path($request->path()))) {
            return redirect('/assets/' . $request->path());
        }

        return $next($request);
    }
}
