<?php

namespace App\Actions\RegimeLevel;

use App\Models\RegimeLevel;
use Lorisleiva\Actions\Concerns\AsAction;

class IndexRegimeLevel
{
    use AsAction;

    public function handle(string $searchTerm = ''): \Illuminate\Support\Collection
    {
        $query = RegimeLevel::query();

        if ($searchTerm) {
            $query->where('name', 'like', "%{$searchTerm}%")
                ->orWhere('code', 'like', "%{$searchTerm}%");
        }

        return $query->get();
    }
}
