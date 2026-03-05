<?php

namespace App\Livewire\Components\Regimes;

use App\Actions\Regime\StoreRegime;
use Flux\Flux;
use Livewire\Attributes\On;
use Livewire\Component;

class CreateRegimeComponent extends Component
{
    public string $name = '';

    public ?string $description = null;

    public ?string $legalBasis = null;

    private function checkAuthentication(): bool
    {
        if (!auth()->check()) {
            $this->addError('auth', 'Debe estar autenticado para realizar esta acción.');
            return false;
        }
        return true;
    }

    private function buildData(): array
    {
        return [
            'name' => $this->name,
            'description' => $this->description,
            'legal_basis' => $this->legalBasis,
        ];
    }

    public function render()
    {
        return view('livewire.components.regimes.create-regime-component');
    }

    #[On('regime.create')]
    public function create()
    {
        if (!$this->checkAuthentication()) {
            return;
        }

        $this->resetErrorBag();
        $this->reset(['name', 'description', 'legalBasis']);
        Flux::modal('create-regime-modal')->show();
    }

    public function store()
    {
        if (!$this->checkAuthentication()) {
            return;
        }

        $regime = StoreRegime::run($this->buildData());

        $this->resetErrorBag();
        $this->reset(['name', 'description', 'legalBasis']);
        Flux::modal('create-regime-modal')->close();

        $this->dispatch('regime.stored', $regime);
    }
}
