<?php

namespace App\Livewire\Components\RegimeLevels;

use App\Actions\RegimeLevel\ShowRegimeLevel;
use App\Actions\RegimeLevel\UpdateRegimeLevel;
use Flux\Flux;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class EditRegimeLevelComponent extends Component
{
    public int $id;

    public ?string $name = null;

    public ?string $code = null;

    public ?int $regimeId = null;

    public function render(): View
    {
        return view('livewire.components.regime-levels.edit-regime-level-component');
    }

    public function loadData(int $id): void
    {
        $regimeLevel = ShowRegimeLevel::run($id);
        $this->id = $id;
        $this->name = $regimeLevel->name;
        $this->code = $regimeLevel->code;
        $this->regimeId = $regimeLevel->regime_id;
    }

    private function buildData(): array
    {
        return [
            'name' => $this->name,
            'code' => $this->code,
            'regime_id' => $this->regimeId,
        ];
    }

    #[On('regime-level.edit')]
    public function edit(int $id): void
    {
        $this->resetErrorBag();
        $this->reset(['name', 'code']);
        $this->loadData($id);

        Flux::modal('edit-regime-level-modal')->show();
    }

    public function update(): void
    {
        $regimeLevel = UpdateRegimeLevel::run($this->id, $this->buildData());
        Flux::modal('edit-regime-level-modal')->close();

        $this->dispatch('regime-level.updated', $regimeLevel);
    }
}
