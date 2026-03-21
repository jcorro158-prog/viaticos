<?php

namespace App\Livewire;

use App\Models\Commission;
use Livewire\Component;

class CommissionShowComponent extends Component
{
    public Commission $commission;

    public function mount(Commission $commission): void
    {
        $this->commission = $commission->load(['user', 'commissionStatus', 'resolutions']);
    }

    public function render()
    {
        return view('livewire.commission-show-component')
            ->layout('components.layouts.app', [
                'title' => 'Detalle comisión',
            ]);
    }
}