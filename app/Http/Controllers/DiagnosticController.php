<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;

class DiagnosticController extends Controller
{
    public function microsoftTest()
    {
        try {
            $config = config('services.microsoft');
            $driver = Socialite::driver('microsoft');

            $data = [
                'status' => 'success',
                'message' => 'Configuración de Microsoft OAuth verificada',
                'config' => [
                    'client_id' => $config['client_id'] ?? 'No configurado',
                    'client_secret' => $config['client_secret'] ? 'Configurado ✅' : 'No configurado ❌',
                    'redirect_uri' => $config['redirect'] ?? 'No configurado',
                ],
                'driver_loaded' => true,
                'test_url' => route('auth.microsoft'),
            ];

            return response()->json($data, 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error en configuración de Microsoft OAuth',
                'error' => $e->getMessage(),
                'suggestion' => 'Revisa SOLUCION_UNAUTHORIZED_CLIENT.md',
            ], 500);
        }
    }

    public function microsoftInfo()
    {
        $config = config('services.microsoft');

        return view('diagnostic.microsoft', [
            'config' => $config,
            'authUrl' => route('auth.microsoft'),
            'callbackUrl' => route('auth.microsoft.callback'),
        ]);
    }
}
