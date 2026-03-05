<?php

namespace App\Actions\RegimeLevelGrade;

use App\Models\RegimeLevelGrade;
use Lorisleiva\Actions\Concerns\AsAction;

class IndexRegimeLevelGrade
{
    use AsAction;

    public function handle(string $searchTerm = ''): \Illuminate\Support\Collection
    {
        $query = RegimeLevelGrade::query();

        if ($searchTerm) {
            $query->where('name', 'like', "%{$searchTerm}%");
        }

        return $query->get();
    }
}
