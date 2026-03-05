<?php

namespace Database\Factories;

use App\Models\CommissionStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommissionStatusFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CommissionStatus::class;

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
