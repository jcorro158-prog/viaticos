<?php

namespace Database\Factories;

use App\Models\Budget;
use App\Models\BudgetSource;
use App\Models\Dependency;
use Illuminate\Database\Eloquent\Factories\Factory;

class BudgetFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Budget::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'decree' => fake()->text(),
            'code' => fake()->text(),
            'year' => fake()->year(),
            'in_force' => fake()->boolean(),
            'dependency_id' => Dependency::factory(),
            'budget_source_id' => BudgetSource::factory(),
        ];
    }
}
