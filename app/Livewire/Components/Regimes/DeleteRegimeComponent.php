<?php

namespace App\Livewire\Components\Regimes;

use App\Actions\Regime\DestroyRegime;
use Flux\Flux;
use Livewire\Attributes\On;
use Livewire\Component;

class DeleteRegimeComponent extends Component
{
    public int $id;

    private function checkAuthentication(): bool
    {
        if (!auth()->check()) {
            $this->addError('auth', 'Debe estar autenticado para realizar esta acción.');
            return false;
        }
        return true;
    }

    public function render()
    {
        return view('livewire.components.regimes.delete-regime-component');
    }

    #[On('regime.delete')]
    public function delete(int $id)
    {
        if (!$this->checkAuthentication()) {
            return;
        }

        $this->id = $id;
        Flux::modal('delete-regime-modal')->show();
    }

    public function destroy()
    {
        if (!$this->checkAuthentication()) {
            return;
        }

        $isDestroyed = DestroyRegime::run($this->id);

        Flux::modal('delete-regime-modal')->close();
        $this->dispatch('regime.destroyed', $isDestroyed);
    }
}
