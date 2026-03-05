<?php

namespace App\Livewire\Components\SalaryScaleDecrees;

use App\Actions\SalaryScaleDecree\ShowSalaryScaleDecree;
use App\Actions\SalaryScaleDecree\UpdateSalaryScaleDecree;
use Carbon\Carbon;
use Flux\Flux;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class EditSalaryScaleDecreeComponent extends Component
{
    public int $id;

    public ?string $decree = null;

    public ?string $description = null;

    public ?string $date = null;

    public function render(): View
    {
        return view('livewire.components.salary-scale-decrees.edit-salary-scale-decree-component');
    }

    public function loadData(int $id): void
    {
        $salaryScaleDecree = ShowSalaryScaleDecree::run($id);
        $this->id = $id;
        $this->decree = $salaryScaleDecree->decree;
        $this->description = $salaryScaleDecree->description;
        $this->date = Carbon::parse($salaryScaleDecree->date)->format('Y-m-d');
    }

    private function buildData(): array
    {
        return [
            'decree' => $this->decree,
            'description' => $this->description,
            'date' => $this->date,
        ];
    }

    #[On('salary-scale-decree.edit')]
    public function edit(int $id): void
    {
        $this->resetErrorBag();
        $this->reset(['decree', 'description', 'date']);
        $this->loadData($id);

        Flux::modal('edit-salary-scale-decree-modal')->show();
    }

    public function update(): void
    {
        $salaryScaleDecree = UpdateSalaryScaleDecree::run($this->id, $this->buildData());
        Flux::modal('edit-salary-scale-decree-modal')->close();

        $this->dispatch('salary-scale-decree.updated', $salaryScaleDecree);
    }
}
