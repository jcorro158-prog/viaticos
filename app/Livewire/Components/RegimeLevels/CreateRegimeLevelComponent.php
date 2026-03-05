<?php

namespace App\Livewire\Components\RegimeLevels;

use App\Actions\RegimeLevel\StoreRegimeLevel;
use Flux\Flux;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class CreateRegimeLevelComponent extends Component
{
    public ?string $name = null;

    public ?string $code = null;

    public ?int $regimeId = null;

    public function render(): View
    {
        return view('livewire.components.regime-levels.create-regime-level-component');
    }

    private function buildData(): array
    {
        return [
            'name' => $this->name,
            'code' => $this->code,
            'regime_id' => $this->regimeId,
        ];
    }

    #[On('regime-level.create')]
    public function create(): void
    {
        $this->resetErrorBag();
        $this->reset(['name', 'code']);
        Flux::modal('create-regime-level-modal')->show();
    }

    public function store(): void
    {
        $regimeLevel = StoreRegimeLevel::run($this->buildData());

        $this->resetErrorBag();
        $this->reset(['name', 'code']);
        Flux::modal('create-regime-level-modal')->close();

        $this->dispatch('regime-level.stored', $regimeLevel);
    }
}
