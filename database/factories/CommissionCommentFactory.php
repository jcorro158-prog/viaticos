<?php

namespace Database\Factories;

use App\Models\Commission;
use App\Models\CommissionComment;
use App\Models\CommissionStatus;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommissionCommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CommissionComment::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'comment' => fake()->text(),
            'commission_id' => Commission::factory(),
            'user_id' => User::factory(),
            'commission_status_id' => CommissionStatus::factory(),
        ];
    }
}
