<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class MicrosoftAuthController extends Controller
{
    /**
     * Redirect the user to the Microsoft authentication page.
     * ACTUALIZADO: Fuerza re-autenticación para máxima seguridad en sistema gubernamental
     */
    public function redirectToMicrosoft()
    {
        // Construir la URL con parámetros adicionales para forzar re-autenticación
        $driver = Socialite::driver('microsoft');

        // Obtener la URL de autorización base
        $authUrl = $driver->redirect()->getTargetUrl();

        // Agregar parámetros de seguridad para forzar re-autenticación
        $securityParams = http_build_query([
            'prompt' => 'login',        // CRÍTICO: Siempre mostrar pantalla de login
            'max_age' => 0,             // No usar tokens en caché
        ]);

        // Combinar URL con parámetros adicionales
        $separator = strpos($authUrl, '?') !== false ? '&' : '?';
        $finalUrl = $authUrl.$separator.$securityParams;

        return redirect($finalUrl);
    }

    /**
     * Obtain the user information from Microsoft.
     * NOTA: Este es el ÚNICO método de registro disponible en el sistema.
     * No se permite registro manual - solo através de Microsoft OAuth.
     */
    public function handleMicrosoftCallback()
    {
        try {
            $microsoftUser = Socialite::driver('microsoft')->user();

            // Extraer información adicional del usuario de Microsoft Graph
            $givenName = $microsoftUser->user['givenName'] ?? null;
            $surname = $microsoftUser->user['surname'] ?? null;

            Log::info('Microsoft User Data: ', [
                'id' => $microsoftUser->getId(),
                'name' => $microsoftUser->getName(),
                'email' => $microsoftUser->getEmail(),
                'avatar' => $microsoftUser->getAvatar(),
                'givenName' => $givenName,
                'surname' => $surname,
                'general' => $microsoftUser,
            ]);

            // Verificar si el usuario ya existe
            $user = User::where('email', $microsoftUser->getEmail())->first();

            if ($user) {
                // Usuario existe, actualizar información si es necesario
                $user->update([
                    'microsoft_id' => $microsoftUser->getId(),
                    'avatar' => $microsoftUser->getAvatar(),
                    'name' => $givenName ?: $microsoftUser->getName(),
                    'surname' => $surname,
                ]);
            } else {
                // Crear nuevo usuario (ÚNICO método de registro permitido)
                $user = User::create([
                    'name' => $givenName ?: $microsoftUser->getName(),
                    'surname' => $surname,
                    'email' => $microsoftUser->getEmail(),
                    'microsoft_id' => $microsoftUser->getId(),
                    'avatar' => $microsoftUser->getAvatar(),
                    'email_verified_at' => now(),
                    'password' => bcrypt(Str::random(24)), // Password aleatorio ya que usa OAuth
                ]);
            }

            // Autenticar al usuario
            Auth::login($user, true);

            return redirect()->intended('/dashboard');

        } catch (\Exception $e) {
            return redirect('/login')->with('error', 'Error al autenticar con Microsoft: '.$e->getMessage());
        }
    }
}
