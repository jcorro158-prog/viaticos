<?php

namespace App\Actions\RegimeLevelGrade;

use App\Models\RegimeLevelGrade;
use Lorisleiva\Actions\Concerns\AsAction;

class ShowRegimeLevelGrade
{
    use AsAction;

    public function handle(int $id): RegimeLevelGrade
    {
        return RegimeLevelGrade::findOrFail($id);
    }
}
