<?php

namespace Database\Factories;

use App\Models\Commission;
use App\Models\Resolution;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ResolutionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Resolution::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'number' => fake()->word(),
            'date' => fake()->date(),
            'file' => fake()->word(),
            'user_id' => User::factory(),
            'commission_id' => Commission::factory(),
        ];
    }
}
