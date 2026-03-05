<?php

namespace Database\Factories;

use App\Models\Regime;
use Illuminate\Database\Eloquent\Factories\Factory;

class RegimeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Regime::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'description' => fake()->text(),
            'legal_basis' => fake()->text(),
        ];
    }
}
