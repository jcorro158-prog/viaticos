<?php

namespace App\Actions\SalaryScale;

use App\Models\SalaryScale;
use Lorisleiva\Actions\Concerns\AsAction;

class ShowSalaryScale
{
    use AsAction;

    public function handle(int $id): SalaryScale
    {
        return SalaryScale::findOrFail($id);
    }
}
