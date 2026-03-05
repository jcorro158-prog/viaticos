<?php

namespace Database\Factories;

use App\Models\Dependency;
use App\Models\JobTitle;
use Illuminate\Database\Eloquent\Factories\Factory;

class JobTitleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = JobTitle::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'active' => fake()->boolean(),
            'dependency_id' => Dependency::factory(),
        ];
    }
}
