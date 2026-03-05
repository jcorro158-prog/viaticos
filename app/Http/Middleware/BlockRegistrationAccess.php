<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BlockRegistrationAccess
{
    /**
     * Handle an incoming request.
     *
     * Este middleware bloquea cualquier intento de acceso a rutas de registro.
     * Solo se permite el registro a través de Microsoft OAuth.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Si la URL contiene 'register' y no es la de Microsoft, bloquear
        if (str_contains($request->path(), 'register') && ! str_contains($request->path(), 'microsoft')) {
            abort(404, 'Registro no disponible. Use autenticación Microsoft.');
        }

        return $next($request);
    }
}
