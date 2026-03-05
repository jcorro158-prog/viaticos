<?php

namespace App\Livewire\Components\RegimeLevels;

use App\Actions\RegimeLevel\DestroyRegimeLevel;
use Flux\Flux;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class DeleteRegimeLevelComponent extends Component
{
    public int $id;

    public function render(): View
    {
        return view('livewire.components.regime-levels.delete-regime-level-component');
    }

    #[On('regime-level.delete')]
    public function delete(int $id): void
    {
        $this->id = $id;
        Flux::modal('delete-regime-level-modal')->show();
    }

    public function destroy(): void
    {
        $isDestroyed = DestroyRegimeLevel::run($this->id);

        Flux::modal('delete-regime-level-modal')->close();
        $this->dispatch('regime-level.destroyed', $isDestroyed);
    }
}
