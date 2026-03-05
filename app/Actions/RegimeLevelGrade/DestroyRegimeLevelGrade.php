<?php

namespace App\Actions\RegimeLevelGrade;

use App\Models\RegimeLevelGrade;
use Lorisleiva\Actions\Concerns\AsAction;

class DestroyRegimeLevelGrade
{
    use AsAction;

    public function handle(int $id): bool
    {
        $regimeLevelGrade = RegimeLevelGrade::findOrFail($id);

        return $regimeLevelGrade->delete();
    }
}
