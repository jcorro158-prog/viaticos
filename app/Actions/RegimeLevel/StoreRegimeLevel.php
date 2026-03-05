<?php

namespace App\Actions\RegimeLevel;

use App\Models\RegimeLevel;
use Illuminate\Support\Facades\Validator;
use Lorisleiva\Actions\Concerns\AsAction;

class StoreRegimeLevel
{
    use AsAction;

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255|min:3',
            'code' => 'required|string|max:255',
            'regime_id' => 'required|integer|exists:regimes,id',
        ];
    }

    public function handle($data): RegimeLevel
    {
        Validator::make($data, $this->rules())->validate();

        return RegimeLevel::create($data);
    }
}
