<?php

namespace Database\Factories;

use App\Models\VinvulationType;
use Illuminate\Database\Eloquent\Factories\Factory;

class VinvulationTypeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = VinvulationType::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
        ];
    }
}
