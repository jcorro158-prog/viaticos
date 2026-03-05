<?php

namespace Database\Factories;

use App\Models\Commission;
use App\Models\CommissionExpense;
use App\Models\ExpenseType;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommissionExpenseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CommissionExpense::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'value' => fake()->randomFloat(0, 0, 9999999999.),
            'commission_id' => Commission::factory(),
            'expense_type_id' => ExpenseType::factory(),
        ];
    }
}
