<?php

namespace App\Livewire\Components\SalaryScaleDecrees;

use App\Actions\SalaryScaleDecree\DestroySalaryScaleDecree;
use Flux\Flux;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class DeleteSalaryScaleDecreeComponent extends Component
{
    public int $id;

    public function render(): View
    {
        return view('livewire.components.salary-scale-decrees.delete-salary-scale-decree-component');
    }

    #[On('salary-scale-decree.delete')]
    public function delete(int $id): void
    {
        $this->id = $id;
        Flux::modal('delete-salary-scale-decree-modal')->show();
    }

    public function destroy(): void
    {
        $isDestroyed = DestroySalaryScaleDecree::run($this->id);

        Flux::modal('delete-salary-scale-decree-modal')->close();
        $this->dispatch('salary-scale-decree.destroyed', $isDestroyed);
    }
}
