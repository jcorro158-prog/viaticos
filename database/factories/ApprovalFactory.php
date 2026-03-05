<?php

namespace Database\Factories;

use App\Models\Approval;
use App\Models\ApprovalType;
use App\Models\Commission;
use App\Models\Dependency;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ApprovalFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Approval::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'dependency_id' => Dependency::factory(),
            'approval_type_id' => ApprovalType::factory(),
            'commission_id' => Commission::factory(),
            'user_id' => User::factory(),
        ];
    }
}
