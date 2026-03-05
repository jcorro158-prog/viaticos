<?php

namespace App\Livewire\Components\SalaryScaleDecrees;

use App\Actions\SalaryScaleDecree\StoreSalaryScaleDecree;
use Flux\Flux;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class CreateSalaryScaleDecreeComponent extends Component
{
    public ?string $decree = null;

    public ?string $description = null;

    public ?string $date = null;

    public function render(): View
    {
        return view('livewire.components.salary-scale-decrees.create-salary-scale-decree-component');
    }

    private function buildData(): array
    {
        return [
            'decree' => $this->decree,
            'description' => $this->description,
            'date' => $this->date,
        ];
    }

    #[On('salary-scale-decree.create')]
    public function create(): void
    {
        $this->resetErrorBag();
        $this->reset(['decree', 'description', 'date']);
        Flux::modal('create-salary-scale-decree-modal')->show();
    }

    public function store(): void
    {
        $salaryScaleDecree = StoreSalaryScaleDecree::run($this->buildData());

        $this->resetErrorBag();
        $this->reset(['decree', 'description', 'date']);
        Flux::modal('create-salary-scale-decree-modal')->close();

        $this->dispatch('salary-scale-decree.stored', $salaryScaleDecree);
    }
}
