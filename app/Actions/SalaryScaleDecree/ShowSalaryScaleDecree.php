<?php

namespace App\Actions\SalaryScaleDecree;

use App\Models\SalaryScaleDecree;
use Lorisleiva\Actions\Concerns\AsAction;

class ShowSalaryScaleDecree
{
    use AsAction;

    public function handle(int $id): SalaryScaleDecree
    {
        return SalaryScaleDecree::findOrFail($id);
    }
}
