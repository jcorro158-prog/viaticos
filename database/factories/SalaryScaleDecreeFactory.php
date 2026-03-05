<?php

namespace Database\Factories;

use App\Models\SalaryScaleDecree;
use Illuminate\Database\Eloquent\Factories\Factory;

class SalaryScaleDecreeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SalaryScaleDecree::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'decree' => fake()->text(),
            'description' => fake()->text(),
            'date' => fake()->date(),
        ];
    }
}
