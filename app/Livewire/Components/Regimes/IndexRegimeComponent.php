<?php

namespace App\Livewire\Components\Regimes;

use App\Actions\Regime\IndexRegime;
use Illuminate\Support\Collection;
use Livewire\Attributes\On;
use Livewire\Component;

class IndexRegimeComponent extends Component
{
    public Collection $regimes;

    public function mount()
    {
        $this->indexRegime();
    }

    #[On('regime.stored'), On('regime.updated'), On('regime.destroyed')]
    public function indexRegime()
    {
        $this->regimes = IndexRegime::run();
    }

    public function render()
    {
        return view('livewire.components.regimes.index-regime-component');
    }
}
