<?php

namespace App\Actions\Regime;

use App\Models\Regime;
use Illuminate\Support\Facades\Validator;
use Lorisleiva\Actions\Concerns\AsAction;

class StoreRegime
{
    use AsAction;

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255|min:3',
            'description' => 'nullable|string|max:1000|min:3',
            'legalBasis' => 'nullable|string|max:500|min:3',
        ];
    }

    public function handle($data): Regime
    {
        Validator::make($data, $this->rules())->validate();

        return Regime::create($data);
    }
}
