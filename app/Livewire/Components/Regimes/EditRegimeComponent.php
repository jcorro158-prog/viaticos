<?php

namespace App\Livewire\Components\Regimes;

use App\Actions\Regime\ShowRegime;
use App\Actions\Regime\UpdateRegime;
use Flux\Flux;
use Livewire\Attributes\On;
use Livewire\Component;

class EditRegimeComponent extends Component
{
    public int $id;

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

    public function loadData(int $id): void
    {
        $regime = ShowRegime::run($id);
        $this->id = $id;
        $this->name = $regime->name;
        $this->description = $regime->description;
        $this->legalBasis = $regime->legal_basis;
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
        return view('livewire.components.regimes.edit-regime-component');
    }

    #[On('regime.edit')]
    public function edit(int $id)
    {
        if (!$this->checkAuthentication()) {
            return;
        }

        $this->resetErrorBag();
        $this->reset(['name', 'description', 'legalBasis']);
        $this->loadData($id);

        Flux::modal('edit-regime-modal')->show();
    }

    public function update()
    {
        if (!$this->checkAuthentication()) {
            return;
        }

        $regime = UpdateRegime::run($this->id, $this->buildData());
        Flux::modal('edit-regime-modal')->close();

        $this->dispatch('regime.updated', $regime);
    }
}
