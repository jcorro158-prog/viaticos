<?php

namespace Tests\Feature\Middleware;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EnsureProfileCompleteTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_with_complete_profile_can_access_protected_routes(): void
    {
        $user = User::factory()->create([
            'name' => 'Test User',
            'surname' => 'Test Surname',
            'dni' => '12345678',
            'cellphone' => '3001234567',
            'address' => 'Test Address 123',
        ]);

        $this->actingAs($user);

        $response = $this->get('/dashboard');

        $response->assertStatus(200);
    }

    public function test_user_with_incomplete_profile_is_redirected_to_profile_settings(): void
    {
        // Usuario con perfil incompleto (falta surname)
        $user = User::factory()->create([
            'name' => 'Test User',
            'surname' => null,
            'dni' => '12345678',
            'cellphone' => '3001234567',
            'address' => 'Test Address 123',
        ]);

        $this->actingAs($user);

        $response = $this->get('/dashboard');

        $response->assertRedirect('/settings/profile');
        $response->assertSessionHas('warning', 'Por favor, complete toda la información de su perfil para continuar navegando.');
    }

    public function test_user_with_empty_name_is_redirected(): void
    {
        $user = User::factory()->create([
            'name' => '',
            'surname' => 'Test Surname',
            'dni' => '12345678',
            'cellphone' => '3001234567',
            'address' => 'Test Address 123',
        ]);

        $this->actingAs($user);

        $response = $this->get('/usuarios');

        $response->assertRedirect('/settings/profile');
    }

    public function test_user_with_empty_dni_is_redirected(): void
    {
        $user = User::factory()->create([
            'name' => 'Test User',
            'surname' => 'Test Surname',
            'dni' => '',
            'cellphone' => '3001234567',
            'address' => 'Test Address 123',
        ]);

        $this->actingAs($user);

        $response = $this->get('/comisiones');

        $response->assertRedirect('/settings/profile');
    }

    public function test_user_with_empty_cellphone_is_redirected(): void
    {
        $user = User::factory()->create([
            'name' => 'Test User',
            'surname' => 'Test Surname',
            'dni' => '12345678',
            'cellphone' => '',
            'address' => 'Test Address 123',
        ]);

        $this->actingAs($user);

        $response = $this->get('/parametrizacion');

        $response->assertRedirect('/settings/profile');
    }

    public function test_user_with_empty_address_is_redirected(): void
    {
        $user = User::factory()->create([
            'name' => 'Test User',
            'surname' => 'Test Surname',
            'dni' => '12345678',
            'cellphone' => '3001234567',
            'address' => '',
        ]);

        $this->actingAs($user);

        $response = $this->get('/dashboard');

        $response->assertRedirect('/settings/profile');
    }

    public function test_settings_routes_are_accessible_with_incomplete_profile(): void
    {
        // Usuario con perfil incompleto
        $user = User::factory()->create([
            'name' => 'Test User',
            'surname' => null,
            'dni' => null,
            'cellphone' => null,
            'address' => null,
        ]);

        $this->actingAs($user);

        // Las rutas de configuración deben ser accesibles
        $response = $this->get('/settings/profile');
        $response->assertStatus(200);

        $response = $this->get('/settings/password');
        $response->assertStatus(200);

        $response = $this->get('/settings/appearance');
        $response->assertStatus(200);
    }

    public function test_authentication_routes_are_accessible_with_incomplete_profile(): void
    {
        // Usuario con perfil incompleto
        $user = User::factory()->create([
            'name' => 'Test User',
            'surname' => null,
            'dni' => null,
            'cellphone' => null,
            'address' => null,
        ]);

        $this->actingAs($user);

        // Las rutas de autenticación deben ser accesibles
        $response = $this->get('/auth/microsoft');
        $response->assertRedirect(); // Redirección a Microsoft es normal
    }

    public function test_guest_users_are_not_affected_by_profile_middleware(): void
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
    }
}
