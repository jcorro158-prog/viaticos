<?php

namespace App\Actions\RegimeLevel;

use App\Models\RegimeLevel;
use Lorisleiva\Actions\Concerns\AsAction;

class ShowRegimeLevel
{
    use AsAction;

    public function handle(int $id): RegimeLevel
    {
        return RegimeLevel::findOrFail($id);
    }
}
