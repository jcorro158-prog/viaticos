<?php

namespace App\Actions\RegimeLevel;

use App\Models\RegimeLevel;
use Lorisleiva\Actions\Concerns\AsAction;

class DestroyRegimeLevel
{
    use AsAction;

    public function handle(int $id): bool
    {
        $regimeLevel = RegimeLevel::findOrFail($id);

        return $regimeLevel->delete();
    }
}
