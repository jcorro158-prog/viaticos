<?php

namespace Tests\Feature\Livewire\Regimes;

use App\Livewire\Components\Regimes\CreateRegimeComponent;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class CreateRegimeTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    protected function setUp(): void
    {
        parent::setUp();
        
        $this->user = User::factory()->create();
    }

    // El usuario autenticado puede crear un régimen
    /** @test */
    public function authenticated_user_can_create_a_regime(): void
    {
        $this->actingAs($this->user);

        $component = Livewire::test(CreateRegimeComponent::class)
            ->set('name', 'Régimen de Prueba')
            ->set('description', 'Descripción del régimen de prueba')
            ->set('legalBasis', 'Ley 123/2024')
            ->call('store');

        $component->assertHasNoErrors();

        // Verificar que el régimen fue creado en la base de datos
        $this->assertDatabaseHas('regimes', [
            'name' => 'Régimen de Prueba',
            'description' => 'Descripción del régimen de prueba',
            'legal_basis' => 'Ley 123/2024'
        ]);

        // Verificar que existe exactamente un régimen
        $this->assertDatabaseCount('regimes', 1);
    }

    // Crear régimen valida los campos obligatorios
    /** @test */
    public function create_regime_validates_required_fields(): void
    {
        $this->actingAs($this->user);

        $component = Livewire::test(CreateRegimeComponent::class)
            ->set('name', '') // Campo requerido vacío
            ->call('store');

        $component->assertHasErrors(['name']);
        
        // Verificar que no se creó ningún régimen
        $this->assertDatabaseCount('regimes', 0);
    }

    // Crear régimen valida la longitud mínima
    /** @test */
    public function create_regime_validates_minimum_length(): void
    {
        $this->actingAs($this->user);

        $component = Livewire::test(CreateRegimeComponent::class)
            ->set('name', 'AB') // Menos de 3 caracteres
            ->call('store');

        $component->assertHasErrors(['name']);
        $this->assertDatabaseCount('regimes', 0);
    }

    // Crear régimen valida la longitud máxima
    /** @test */
    public function create_regime_validates_maximum_length(): void
    {
        $this->actingAs($this->user);

        $component = Livewire::test(CreateRegimeComponent::class)
            ->set('name', str_repeat('A', 256)) // Más de 255 caracteres
            ->call('store');

        $component->assertHasErrors(['name']);
        $this->assertDatabaseCount('regimes', 0);
    }

    // El usuario no autenticado no puede crear un régimen
    /** @test */
    public function unauthenticated_user_cannot_create_a_regime(): void
    {
        // Sin autenticar al usuario
        $component = Livewire::test(CreateRegimeComponent::class)
            ->set('name', 'Régimen de Prueba')
            ->call('store');

        $component->assertHasErrors(['auth']);
        
        // Verificar que no se creó ningún régimen
        $this->assertDatabaseCount('regimes', 0);
    }

    // Crear régimen solo con campos obligatorios
    /** @test */
    public function create_regime_with_only_required_fields(): void
    {
        $this->actingAs($this->user);

        $component = Livewire::test(CreateRegimeComponent::class)
            ->set('name', 'Régimen Mínimo')
            ->set('description', null)
            ->set('legalBasis', null)
            ->call('store');

        $component->assertHasNoErrors();

        $this->assertDatabaseHas('regimes', [
            'name' => 'Régimen Mínimo',
            'description' => null,
            'legal_basis' => null
        ]);
    }

    // Crear régimen envía evento en caso de éxito
    /** @test */
    public function create_regime_dispatches_event_on_success(): void
    {
        $this->actingAs($this->user);

        $component = Livewire::test(CreateRegimeComponent::class)
            ->set('name', 'Régimen con Evento')
            ->call('store');

        $component->assertDispatched('regime.stored');
    }

    // Crear régimen reinicia el formulario después del éxito
    /** @test */
    public function create_regime_resets_form_after_success(): void
    {
        $this->actingAs($this->user);

        $component = Livewire::test(CreateRegimeComponent::class)
            ->set('name', 'Régimen de Prueba')
            ->set('description', 'Descripción de prueba')
            ->set('legalBasis', 'Base legal de prueba')
            ->call('store');

        // Verificar que los campos se resetearon
        $component->assertSet('name', '');
        $component->assertSet('description', null);
        $component->assertSet('legalBasis', null);
    }

    // Crear régimen valida longitud mínima de campos opcionales
    /** @test */
    public function create_regime_validates_optional_field_minimum_length(): void
    {
        $this->actingAs($this->user);

        $component = Livewire::test(CreateRegimeComponent::class)
            ->set('name', 'Régimen Válido')
            ->set('description', 'AB') // Menos de 3 caracteres en campo opcional
            ->call('store');

        $component->assertHasErrors(['description']);
        $this->assertDatabaseCount('regimes', 0);
    }

    // Crear régimen valida longitud máxima de campos opcionales
    /** @test */
    public function create_regime_validates_optional_field_maximum_length(): void
    {
        $this->actingAs($this->user);

        $component = Livewire::test(CreateRegimeComponent::class)
            ->set('name', 'Régimen Válido')
            ->set('description', str_repeat('A', 1001)) // Más de 1000 caracteres
            ->call('store');

        $component->assertHasErrors(['description']);
        $this->assertDatabaseCount('regimes', 0);
    }
}
