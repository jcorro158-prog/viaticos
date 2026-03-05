<?php

namespace App\Actions\SalaryScale;

use App\Models\SalaryScale;
use Lorisleiva\Actions\Concerns\AsAction;

class DestroySalaryScale
{
    use AsAction;

    public function handle(int $id): bool
    {
        $salaryScale = SalaryScale::findOrFail($id);

        return $salaryScale->delete();
    }
}
