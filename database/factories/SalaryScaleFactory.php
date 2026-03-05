<?php

namespace Database\Factories;

use App\Models\RegimeLevelGrade;
use App\Models\SalaryScale;
use App\Models\SalaryScaleDecree;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class SalaryScaleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SalaryScale::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'year' => fake()->year(),
            'active' => fake()->boolean(),
            'base_salary' => fake()->randomFloat(0, 0, 9999999999.),
            'regime_level_grade_id' => RegimeLevelGrade::factory(),
            'salary_scale_decree_id' => SalaryScaleDecree::factory(),
            'user_id' => User::factory(),
        ];
    }
}
