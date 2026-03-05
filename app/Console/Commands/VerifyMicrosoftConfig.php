<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Laravel\Socialite\Facades\Socialite;

class VerifyMicrosoftConfig extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'microsoft:verify';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Verificar la configuración de Microsoft OAuth';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🔍 Verificando configuración de Microsoft OAuth...');

        // Verificar variables de entorno
        $clientId = config('services.microsoft.client_id');
        $clientSecret = config('services.microsoft.client_secret');
        $redirectUri = config('services.microsoft.redirect');

        $this->newLine();
        $this->info('📋 Variables de entorno:');
        $this->line('Client ID: '.($clientId ? '✅ Configurado' : '❌ No configurado'));
        $this->line('Client Secret: '.($clientSecret ? '✅ Configurado' : '❌ No configurado'));
        $this->line('Redirect URI: '.($redirectUri ?: '❌ No configurado'));

        if (! $clientId || ! $clientSecret || ! $redirectUri) {
            $this->error('❌ Faltan variables de configuración en .env');

            return 1;
        }

        // Verificar driver de Socialite
        try {
            $driver = Socialite::driver('microsoft');
            $this->info('✅ Driver de Microsoft cargado correctamente');

            // No intentar generar URL en comando de consola debido a sesiones
            $this->info('✅ Configuración básica completada');

        } catch (\Exception $e) {
            $this->error('❌ Error con el driver de Microsoft: '.$e->getMessage());

            return 1;
        }

        $this->newLine();
        $this->info('🎯 Configuración actual:');
        $this->table(['Variable', 'Valor'], [
            ['MICROSOFT_CLIENT_ID', $clientId],
            ['MICROSOFT_CLIENT_SECRET', substr($clientSecret, 0, 10).'...'],
            ['MICROSOFT_REDIRECT_URI', $redirectUri],
        ]);

        $this->newLine();
        $this->warn('⚠️  Si tienes el error "unauthorized_client", revisa:');
        $this->line('1. Azure Portal > App Registration > Authentication');
        $this->line('2. Supported account types debe incluir "personal Microsoft accounts"');
        $this->line('3. Redirect URI debe coincidir exactamente');
        $this->line('4. Consulta: SOLUCION_UNAUTHORIZED_CLIENT.md');

        return 0;
    }
}
