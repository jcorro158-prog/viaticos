<?php

namespace App\Actions\SalaryScaleDecree;

use App\Models\SalaryScaleDecree;
use Lorisleiva\Actions\Concerns\AsAction;

class IndexSalaryScaleDecree
{
    use AsAction;

    public function handle(string $searchTerm = ''): \Illuminate\Support\Collection
    {
        $query = SalaryScaleDecree::query();

        if ($searchTerm) {
            $query->where('decree', 'like', "%{$searchTerm}%");
        }

        return $query->get();
    }
}
