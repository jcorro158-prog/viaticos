<?php

namespace App\Livewire\Components\SalaryScaleDecrees;

use App\Actions\SalaryScaleDecree\IndexSalaryScaleDecree;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class IndexSalaryScaleDecreeComponent extends Component
{
    public Collection $salaryScaleDecrees;

    public function mount()
    {
        $this->indexRegimeLevel();
    }

    public function render(): View
    {
        return view('livewire.components.salary-scale-decrees.index-salary-scale-decree-component');
    }

    #[
        On('salary-scale-decree.stored'),
        On('salary-scale-decree.updated'),
        On('salary-scale-decree.destroyed')
    ]
    public function indexRegimeLevel(): void
    {
        $this->salaryScaleDecrees = IndexSalaryScaleDecree::run();
    }
}
