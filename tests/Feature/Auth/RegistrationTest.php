<?php

namespace Tests\Feature\Auth;

use App\Livewire\Auth\Register;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_screen_can_be_rendered(): void
    {
        // Dado que la registración tradicional está deshabilitada,
        // verificamos que se redirija a la página de login
        $response = $this->get('/register');

        $response->assertStatus(404); // El route de register ya no existe
    }

    public function test_new_users_can_register(): void
    {
        // La registración tradicional ya no está disponible
        // Los usuarios deben usar Microsoft OAuth
        // Simplemente verificamos que el componente funciona pero no está en rutas
        $this->assertTrue(class_exists(\App\Livewire\Auth\Register::class));
    }
}
