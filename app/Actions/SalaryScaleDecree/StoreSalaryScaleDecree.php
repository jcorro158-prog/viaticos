<?php

namespace App\Actions\SalaryScaleDecree;

use App\Models\SalaryScaleDecree;
use Illuminate\Support\Facades\Validator;
use Lorisleiva\Actions\Concerns\AsAction;

class StoreSalaryScaleDecree
{
    use AsAction;

    public function rules(): array
    {
        return [
            'decree' => 'required|string|max:1000|min:3',
            'description' => 'required|string|max:1000|min:3',
            'date' => 'required|date',
        ];
    }

    public function handle($data): SalaryScaleDecree
    {
        Validator::make($data, $this->rules())->validate();

        return SalaryScaleDecree::create($data);
    }
}
