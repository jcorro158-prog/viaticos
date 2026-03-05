<?php

namespace App\Actions\RegimeLevel;

use App\Models\RegimeLevel;
use Illuminate\Support\Facades\Validator;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdateRegimeLevel
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

    public function handle(int $id, array $data): RegimeLevel
    {
        Validator::make($data, $this->rules())->validate();

        $regimeLevel = RegimeLevel::findOrFail($id);
        $regimeLevel->update($data);

        return $regimeLevel;
    }
}
