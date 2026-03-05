<?php

namespace App\Actions\SalaryScale;

use App\Models\SalaryScale;
use Lorisleiva\Actions\Concerns\AsAction;

class IndexSalaryScale
{
    use AsAction;

    public function handle(string $filterYear = ''): \Illuminate\Support\Collection
    {
        $query = SalaryScale::query();

        if ($filterYear) {
            $query->where('year', $filterYear);
        }

        return $query->get();
    }
}
