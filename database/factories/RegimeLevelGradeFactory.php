<?php

namespace Database\Factories;

use App\Models\RegimeLevel;
use App\Models\RegimeLevelGrade;
use Illuminate\Database\Eloquent\Factories\Factory;

class RegimeLevelGradeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = RegimeLevelGrade::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'order' => fake()->numberBetween(-10000, 10000),
            'regime_level_id' => RegimeLevel::factory(),
        ];
    }
}
