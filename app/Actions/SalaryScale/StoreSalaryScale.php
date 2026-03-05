<?php

namespace App\Actions\SalaryScale;

use App\Models\SalaryScale;
use Illuminate\Support\Facades\Validator;
use Lorisleiva\Actions\Concerns\AsAction;

class StoreSalaryScale
{
    use AsAction;

    public function rules(): array
    {
        return [
            'year' => 'required|integer|min:1900|max:2100',
            'active' => 'required|boolean',
            'baseSalary' => 'required|numeric|min:0',
        ];
    }

    public function handle($data): SalaryScale
    {
        Validator::make($data, $this->rules())->validate();

        return SalaryScale::create($data);
    }
}
