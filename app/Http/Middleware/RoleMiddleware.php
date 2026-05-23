<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{

    public function handle(Request $request, Closure $next, string $rol): Response
    {
        if (auth()->check() && auth()->user()->rol === $rol) {
            return $next($request);
        }

        abort(403, 'No tienes permisos para acceder.');
    }
}