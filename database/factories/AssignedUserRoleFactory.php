<?php

namespace Database\Factories;

use App\Models\AssignedUserRole;
use App\Models\Dependency;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class AssignedUserRoleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AssignedUserRole::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'role_id' => Role::factory(),
            'dependency_id' => Dependency::factory(),
        ];
    }
}
