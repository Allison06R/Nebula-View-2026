<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BlockGuest
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            return response()->view('errors.denegado', [], 403);
        }

        return $next($request);
    }
}