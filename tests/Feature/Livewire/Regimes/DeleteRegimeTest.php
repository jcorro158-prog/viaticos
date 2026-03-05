<?php

namespace Tests\Feature\Livewire\Regimes;

use App\Livewire\Components\Regimes\DeleteRegimeComponent;
use App\Models\Regime;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class DeleteRegimeTest extends TestCase
{
    use RefreshDatabase;

    private User $user;
    private Regime $regime;

    protected function setUp(): void
    {
        parent::setUp();
        
        $this->user = User::factory()->create();
        $this->regime = Regime::factory()->create([
            'name' => 'Régimen a Eliminar',
            'description' => 'Descripción del régimen a eliminar',
            'legal_basis' => 'Base legal del régimen a eliminar'
        ]);
    }

    // El usuario autenticado puede eliminar un régimen
    /** @test */
    public function authenticated_user_can_delete_a_regime(): void
    {
        $this->actingAs($this->user);

        // Verificar que el régimen existe antes de eliminarlo
        $this->assertDatabaseHas('regimes', [
            'id' => $this->regime->id,
            'name' => 'Régimen a Eliminar'
        ]);
        $this->assertDatabaseCount('regimes', 1);

        $component = Livewire::test(DeleteRegimeComponent::class)
            ->call('delete', $this->regime->id)
            ->assertSet('id', $this->regime->id)
            ->call('destroy');

        $component->assertHasNoErrors();

        // Verificar que el régimen fue eliminado de la base de datos
        $this->assertDatabaseMissing('regimes', [
            'id' => $this->regime->id,
            'name' => 'Régimen a Eliminar'
        ]);
        $this->assertDatabaseCount('regimes', 0);
    }

    // El usuario no autenticado no puede eliminar un régimen
    /** @test */
    public function unauthenticated_user_cannot_delete_regime(): void
    {
        // Sin autenticar al usuario
        $component = Livewire::test(DeleteRegimeComponent::class)
            ->call('delete', $this->regime->id)
            ->call('destroy');

        $component->assertHasErrors(['auth']);
        
        // Verificar que el régimen NO fue eliminado
        $this->assertDatabaseHas('regimes', [
            'id' => $this->regime->id,
            'name' => 'Régimen a Eliminar'
        ]);
        $this->assertDatabaseCount('regimes', 1);
    }

    // Eliminar régimen con ID inexistente falla
    /** @test */
    public function delete_regime_with_nonexistent_id_fails(): void
    {
        $this->actingAs($this->user);

        $this->expectException(\Illuminate\Database\Eloquent\ModelNotFoundException::class);

        Livewire::test(DeleteRegimeComponent::class)
            ->call('delete', 99999) // ID que no existe
            ->call('destroy');
    }

    // Eliminar régimen envía evento en caso de éxito
    /** @test */
    public function delete_regime_dispatches_event_on_success(): void
    {
        $this->actingAs($this->user);

        $component = Livewire::test(DeleteRegimeComponent::class)
            ->call('delete', $this->regime->id)
            ->call('destroy');

        $component->assertDispatched('regime.destroyed');
    }

    // El método delete carga correctamente el ID del régimen
    /** @test */
    public function delete_method_loads_regime_id_correctly(): void
    {
        $this->actingAs($this->user);

        $component = Livewire::test(DeleteRegimeComponent::class)
            ->call('delete', $this->regime->id);

        $component->assertSet('id', $this->regime->id);
        $component->assertHasNoErrors();

        // Verificar que el régimen aún existe (solo se cargó el ID, no se eliminó)
        $this->assertDatabaseHas('regimes', [
            'id' => $this->regime->id,
            'name' => 'Régimen a Eliminar'
        ]);
    }

    // Eliminar múltiples regímenes funciona correctamente
    /** @test */
    public function delete_multiple_regimes_works_correctly(): void
    {
        $this->actingAs($this->user);

        // Crear regímenes adicionales
        $regime2 = Regime::factory()->create(['name' => 'Régimen 2']);
        $regime3 = Regime::factory()->create(['name' => 'Régimen 3']);

        // Verificar que hay 3 regímenes
        $this->assertDatabaseCount('regimes', 3);

        // Eliminar el primer régimen
        Livewire::test(DeleteRegimeComponent::class)
            ->call('delete', $this->regime->id)
            ->call('destroy');

        // Verificar que solo se eliminó uno
        $this->assertDatabaseCount('regimes', 2);
        $this->assertDatabaseMissing('regimes', ['id' => $this->regime->id]);
        $this->assertDatabaseHas('regimes', ['id' => $regime2->id]);
        $this->assertDatabaseHas('regimes', ['id' => $regime3->id]);

        // Eliminar el segundo régimen
        Livewire::test(DeleteRegimeComponent::class)
            ->call('delete', $regime2->id)
            ->call('destroy');

        // Verificar que quedan solo 1 régimen
        $this->assertDatabaseCount('regimes', 1);
        $this->assertDatabaseHas('regimes', ['id' => $regime3->id]);
    }

    // El usuario autenticado puede confirmar eliminación sin proceder
    /** @test */
    public function authenticated_user_can_open_delete_modal_without_destroying(): void
    {
        $this->actingAs($this->user);

        $component = Livewire::test(DeleteRegimeComponent::class)
            ->call('delete', $this->regime->id);

        // Verificar que se cargó el ID pero no se eliminó el régimen
        $component->assertSet('id', $this->regime->id);
        $component->assertHasNoErrors();

        // El régimen debe seguir existiendo
        $this->assertDatabaseHas('regimes', [
            'id' => $this->regime->id,
            'name' => 'Régimen a Eliminar'
        ]);
        $this->assertDatabaseCount('regimes', 1);
    }

    // Eliminar régimen retorna el resultado correcto
    /** @test */
    public function delete_regime_returns_correct_result(): void
    {
        $this->actingAs($this->user);

        $component = Livewire::test(DeleteRegimeComponent::class)
            ->call('delete', $this->regime->id)
            ->call('destroy');

        // Verificar que se despachó el evento con el resultado correcto (true)
        $component->assertDispatched('regime.destroyed', true);
    }
}
