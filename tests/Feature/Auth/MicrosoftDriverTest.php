<?php

namespace Tests\Feature\Auth;

use Laravel\Socialite\Facades\Socialite;
use Tests\TestCase;

class MicrosoftDriverTest extends TestCase
{
    public function test_microsoft_driver_is_available()
    {
        // Verificar que el driver de Microsoft esté disponible
        $driver = Socialite::driver('microsoft');

        $this->assertInstanceOf(
            \SocialiteProviders\Microsoft\Provider::class,
            $driver
        );
    }

    public function test_microsoft_redirect_url_is_correct()
    {
        // Test usando la ruta real en lugar del driver directo
        $response = $this->get('/auth/microsoft');

        // Verificar que es una redirección
        $this->assertEquals(302, $response->getStatusCode());

        // Verificar que la URL de redirección contiene Microsoft
        $redirectUrl = $response->getTargetUrl();
        $this->assertStringContainsString('login.microsoftonline.com', $redirectUrl);
        $this->assertStringContainsString('oauth2', $redirectUrl);
    }
}
