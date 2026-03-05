<?php

namespace Tests\Feature\Livewire\Regimes;

use App\Livewire\Components\Regimes\EditRegimeComponent;
use App\Models\Regime;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class EditRegimeTest extends TestCase
{
    use RefreshDatabase;

    private User $user;
    private Regime $regime;

    // Configurar el entorno de prueba
    protected function setUp(): void
    {
        parent::setUp();
        
        $this->user = User::factory()->create();
        $this->regime = Regime::factory()->create([
            'name' => 'Régimen Original',
            'description' => 'Descripción original',
            'legal_basis' => 'Base legal original'
        ]);
    }

    // el usuario autenticado puede editar un régimen
    /** @test */
    public function authenticated_user_can_edit_a_regime(): void
    {
        $this->actingAs($this->user);

        $component = Livewire::test(EditRegimeComponent::class)
            ->call('edit', $this->regime->id)
            ->assertSet('id', $this->regime->id)
            ->assertSet('name', 'Régimen Original')
            ->assertSet('description', 'Descripción original')
            ->assertSet('legalBasis', 'Base legal original')
            ->set('name', 'Régimen Actualizado')
            ->set('description', 'Descripción actualizada')
            ->set('legalBasis', 'Base legal actualizada')
            ->call('update');

        $component->assertHasNoErrors();

        // Verificar que el régimen fue actualizado en la base de datos
        $this->regime->refresh();
        $this->assertEquals('Régimen Actualizado', $this->regime->name);
        $this->assertEquals('Descripción actualizada', $this->regime->description);
        $this->assertEquals('Base legal actualizada', $this->regime->legal_basis);
    }

    // El régimen de edición valida los campos obligatorios
    /** @test */
    public function edit_regime_validates_required_fields(): void
    {
        $this->actingAs($this->user);

        $component = Livewire::test(EditRegimeComponent::class)
            ->call('edit', $this->regime->id)
            ->set('name', '') // Campo requerido vacío
            ->call('update');

        $component->assertHasErrors(['name']);
    }

    // El régimen de edición valida los campos obligatorios
    /** @test */
    public function edit_regime_validates_minimum_length(): void
    {
        $this->actingAs($this->user);

        $component = Livewire::test(EditRegimeComponent::class)
            ->call('edit', $this->regime->id)
            ->set('name', 'AB') // Menos de 3 caracteres
            ->call('update');

        $component->assertHasErrors(['name']);
    }

    // El régimen de edición valida la longitud máxima
    /** @test */
    public function edit_regime_validates_maximum_length(): void
    {
        $this->actingAs($this->user);

        $component = Livewire::test(EditRegimeComponent::class)
            ->call('edit', $this->regime->id)
            ->set('name', str_repeat('A', 256)) // Más de 255 caracteres
            ->call('update');

        $component->assertHasErrors(['name']);
    }

    // El usuario no autenticado no puede editar el régimen
    /** @test */
    public function unauthenticated_user_cannot_edit_regime(): void
    {
        // Sin autenticar al usuario
        $component = Livewire::test(EditRegimeComponent::class)
            ->call('edit', $this->regime->id)
            ->set('name', 'Régimen Actualizado')
            ->call('update');

        $component->assertHasErrors();
        
        // Verificar que el régimen NO fue actualizado
        $this->regime->refresh();
        $this->assertEquals('Régimen Original', $this->regime->name);
    }

    // El régimen de edición con ID inexistente falla
    /** @test */
    public function edit_regime_with_nonexistent_id_fails(): void
    {
        $this->actingAs($this->user);

        $this->expectException(\Illuminate\Database\Eloquent\ModelNotFoundException::class);

        Livewire::test(EditRegimeComponent::class)
            ->call('edit', 99999); // ID que no existe
    }

    // El régimen de edición envía el evento en caso de éxito
    /** @test */
    public function edit_regime_dispatches_event_on_success(): void
    {
        $this->actingAs($this->user);

        $component = Livewire::test(EditRegimeComponent::class)
            ->call('edit', $this->regime->id)
            ->set('name', 'Régimen Actualizado')
            ->call('update');

        $component->assertDispatched('regime.updated');
    }

    // los campos opcionales pueden ser nulos
    /** @test */
    public function optional_fields_can_be_null(): void
    {
        $this->actingAs($this->user);

        $component = Livewire::test(EditRegimeComponent::class)
            ->call('edit', $this->regime->id)
            ->set('name', 'Régimen Actualizado')
            ->set('description', null)
            ->set('legalBasis', null)
            ->call('update');

        $component->assertHasNoErrors();

        $this->regime->refresh();
        $this->assertEquals('Régimen Actualizado', $this->regime->name);
        $this->assertNull($this->regime->description);
        $this->assertNull($this->regime->legal_basis);
    }
}
