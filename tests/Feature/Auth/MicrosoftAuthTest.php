<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\User as SocialiteUser;
use Mockery;
use Tests\TestCase;

class MicrosoftAuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_microsoft_redirect()
    {
        $response = $this->get('/auth/microsoft');

        $this->assertEquals(302, $response->getStatusCode());
        $this->assertStringContainsString('login.microsoftonline.com', $response->getTargetUrl());

        // Verificar que la URL contiene los parámetros de seguridad
        $redirectUrl = $response->getTargetUrl();
        $this->assertStringContainsString('prompt=login', $redirectUrl);
        $this->assertStringContainsString('max_age=0', $redirectUrl);
    }

    public function test_microsoft_callback_creates_new_user()
    {
        $socialiteUser = Mockery::mock(SocialiteUser::class);
        $socialiteUser->shouldReceive('getId')->andReturn('microsoft123');
        $socialiteUser->shouldReceive('getName')->andReturn('Juan Pérez');
        $socialiteUser->shouldReceive('getEmail')->andReturn('juan@barrancabermeja.gov.co');
        $socialiteUser->shouldReceive('getAvatar')->andReturn('https://avatar.url');

        // Simular datos adicionales de Microsoft Graph
        $socialiteUser->user = [
            'givenName' => 'Juan',
            'surname' => 'Pérez',
        ];

        Socialite::shouldReceive('driver->user')->andReturn($socialiteUser);
        Log::shouldReceive('info')->once();

        $response = $this->get('/auth/microsoft/callback');

        $this->assertDatabaseHas('users', [
            'email' => 'juan@barrancabermeja.gov.co',
            'microsoft_id' => 'microsoft123',
            'name' => 'Juan',
            'surname' => 'Pérez',
        ]);

        $response->assertRedirect('/dashboard');
    }

    public function test_microsoft_callback_updates_existing_user()
    {
        // Crear un usuario existente
        $user = User::factory()->create([
            'email' => 'juan@barrancabermeja.gov.co',
            'microsoft_id' => null,
            'name' => 'Nombre Anterior',
            'surname' => 'Apellido Anterior',
        ]);

        $socialiteUser = Mockery::mock(SocialiteUser::class);
        $socialiteUser->shouldReceive('getId')->andReturn('microsoft123');
        $socialiteUser->shouldReceive('getName')->andReturn('Juan Pérez');
        $socialiteUser->shouldReceive('getEmail')->andReturn('juan@barrancabermeja.gov.co');
        $socialiteUser->shouldReceive('getAvatar')->andReturn('https://avatar.url');

        $socialiteUser->user = [
            'givenName' => 'Juan',
            'surname' => 'Pérez',
        ];

        Socialite::shouldReceive('driver->user')->andReturn($socialiteUser);
        Log::shouldReceive('info')->once();

        $response = $this->get('/auth/microsoft/callback');

        $user->refresh();
        $this->assertEquals('microsoft123', $user->microsoft_id);
        $this->assertEquals('Juan', $user->name);
        $this->assertEquals('Pérez', $user->surname);
        $this->assertEquals('https://avatar.url', $user->avatar);

        $response->assertRedirect('/dashboard');
    }

    public function test_microsoft_callback_with_incomplete_profile_data()
    {
        $socialiteUser = Mockery::mock(SocialiteUser::class);
        $socialiteUser->shouldReceive('getId')->andReturn('microsoft123');
        $socialiteUser->shouldReceive('getName')->andReturn('Juan Pérez');
        $socialiteUser->shouldReceive('getEmail')->andReturn('juan@barrancabermeja.gov.co');
        $socialiteUser->shouldReceive('getAvatar')->andReturn(null);

        // Simular datos incompletos de Microsoft Graph
        $socialiteUser->user = [
            'givenName' => 'Juan',
            'surname' => null, // Apellido faltante
        ];

        Socialite::shouldReceive('driver->user')->andReturn($socialiteUser);
        Log::shouldReceive('info')->once();

        $response = $this->get('/auth/microsoft/callback');

        // Usuario creado pero con perfil incompleto
        $this->assertDatabaseHas('users', [
            'email' => 'juan@barrancabermeja.gov.co',
            'name' => 'Juan',
            'surname' => null,
            'dni' => null,
            'cellphone' => null,
            'address' => null,
        ]);

        $response->assertRedirect('/dashboard');

        // Verificar que el middleware redirecciona a perfil por estar incompleto
        $user = User::where('email', 'juan@barrancabermeja.gov.co')->first();
        $this->actingAs($user);

        $dashboardResponse = $this->get('/dashboard');
        $dashboardResponse->assertRedirect('/settings/profile');
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
