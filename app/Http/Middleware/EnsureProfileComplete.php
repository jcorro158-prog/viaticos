<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureProfileComplete
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        // Si el usuario no está autenticado, continuar normalmente
        if (! $user) {
            return $next($request);
        }

        // Rutas que están exentas de la verificación de perfil completo
        $exemptRoutes = [
            'settings*',
            'logout',
            'auth/microsoft*',
            'login',
            'register',
        ];

        // Verificar si la ruta actual está exenta
        foreach ($exemptRoutes as $route) {
            if ($request->is($route)) {
                return $next($request);
            }
        }

        // Verificar si el perfil está completo
        if (empty($user->name) || empty($user->surname) || empty($user->cellphone) ||
            empty($user->dni) || empty($user->address)) {

            // Redirigir al perfil con un mensaje
            return redirect('/settings/profile')
                ->with('warning', 'Por favor, complete toda la información de su perfil para continuar navegando.');
        }

        return $next($request);
    }
}
