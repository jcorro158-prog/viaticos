<?php

namespace App\Actions\Regime;

use App\Models\Regime;
use Lorisleiva\Actions\Concerns\AsAction;

class IndexRegime
{
    use AsAction;

    public function handle(string $searchTerm = ''): \Illuminate\Support\Collection
    {
        $query = Regime::query();

        if ($searchTerm) {
            $query->where('name', 'like', "%{$searchTerm}%");
        }

        return $query->get();
    }
}
