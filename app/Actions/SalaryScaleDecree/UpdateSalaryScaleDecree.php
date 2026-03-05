<?php

namespace App\Actions\SalaryScaleDecree;

use App\Models\SalaryScaleDecree;
use Illuminate\Support\Facades\Validator;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdateSalaryScaleDecree
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

    public function handle(int $id, array $data): SalaryScaleDecree
    {
        Validator::make($data, $this->rules())->validate();

        $salaryScaleDecree = SalaryScaleDecree::findOrFail($id);
        $salaryScaleDecree->update($data);

        return $salaryScaleDecree;
    }
}
