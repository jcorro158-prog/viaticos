<?php

namespace App\Actions\RegimeLevelGrade;

use App\Models\RegimeLevelGrade;
use Illuminate\Support\Facades\Validator;
use Lorisleiva\Actions\Concerns\AsAction;

class StoreRegimeLevelGrade
{
    use AsAction;

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255|min:3',
            'order' => 'required|integer|min:1',
            'regime_level_id' => 'required|exists:regime_levels,id',
        ];
    }

    public function handle($data): RegimeLevelGrade
    {
        Validator::make($data, $this->rules())->validate();

        return RegimeLevelGrade::create($data);
    }
}
