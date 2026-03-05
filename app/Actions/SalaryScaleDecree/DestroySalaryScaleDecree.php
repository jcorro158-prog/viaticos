<?php

namespace App\Actions\SalaryScaleDecree;

use App\Models\SalaryScaleDecree;
use Lorisleiva\Actions\Concerns\AsAction;

class DestroySalaryScaleDecree
{
    use AsAction;

    public function handle(int $id): bool
    {
        $salaryScaleDecree = SalaryScaleDecree::findOrFail($id);

        return $salaryScaleDecree->delete();
    }
}
