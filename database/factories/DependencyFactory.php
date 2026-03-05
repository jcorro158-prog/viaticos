<?php

namespace Database\Factories;

use App\Models\Dependency;
use Illuminate\Database\Eloquent\Factories\Factory;

class DependencyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Dependency::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'default' => fake()->boolean(),
        ];
    }
}
