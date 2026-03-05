<?php

namespace App\Livewire\Components\RegimeLevels;

use App\Actions\RegimeLevel\IndexRegimeLevel;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class IndexRegimeLevelComponent extends Component
{
    public Collection $regimeLevels;

    public ?int $regimeId = null;

    public function mount()
    {
        $this->regimeId = request()->route('regimeId');
        $this->indexRegimeLevel();
    }

    public function render(): View
    {
        return view('livewire.components.regime-levels.index-regime-level-component');
    }

    #[On('regime-level.stored'), On('regime-level.updated'), On('regime-level.destroyed')]
    public function indexRegimeLevel(): void
    {
        $this->regimeLevels = IndexRegimeLevel::run();
    }
}
