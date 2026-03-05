<?php

namespace App\Actions\Regime;

use App\Models\Regime;
use Lorisleiva\Actions\Concerns\AsAction;

class ShowRegime
{
    use AsAction;

    public function handle(int $id): Regime
    {
        return Regime::findOrFail($id);
    }
}
