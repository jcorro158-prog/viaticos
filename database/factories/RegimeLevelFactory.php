<?php

namespace Database\Factories;

use App\Models\Regime;
use App\Models\RegimeLevel;
use Illuminate\Database\Eloquent\Factories\Factory;

class RegimeLevelFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = RegimeLevel::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'code' => fake()->word(),
            'regime_id' => Regime::factory(),
        ];
    }
}
