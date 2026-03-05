<?php

namespace App\Actions\Regime;

use App\Models\Regime;
use Lorisleiva\Actions\Concerns\AsAction;

class DestroyRegime
{
    use AsAction;

    public function handle(int $id): bool
    {
        $regime = Regime::findOrFail($id);

        return $regime->delete();
    }
}
