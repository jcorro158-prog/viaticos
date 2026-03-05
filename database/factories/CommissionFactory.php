<?php

namespace Database\Factories;

use App\Models\Budget;
use App\Models\Commission;
use App\Models\CommissionStatus;
use App\Models\Dependency;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommissionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Commission::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'objetive' => fake()->text(),
            'start_date' => fake()->date(),
            'end_date' => fake()->date(),
            'abroad' => fake()->boolean(),
            'destination' => fake()->text(),
            'training_expenses' => fake()->randomFloat(0, 0, 9999999999.),
            'budget_id' => Budget::factory(),
            'user_id' => User::factory(),
            'commission_status_id' => CommissionStatus::factory(),
            'dependency_id' => Dependency::factory(),
        ];
    }
}
