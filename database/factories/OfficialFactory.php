<?php

namespace Database\Factories;

use App\Models\Official;
use App\Models\RegimeLevelGrade;
use App\Models\User;
use App\Models\VinvulationType;
use Illuminate\Database\Eloquent\Factories\Factory;

class OfficialFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Official::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'start_date' => fake()->date(),
            'end_date' => fake()->date(),
            'user_id' => User::factory(),
            'vinvulation_type_id' => VinvulationType::factory(),
            'regime_level_grade_id' => RegimeLevelGrade::factory(),
        ];
    }
}
