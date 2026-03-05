<?php

namespace Database\Factories;

use App\Models\Commission;
use App\Models\Document;
use App\Models\DocumentType;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class DocumentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Document::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'commets' => fake()->text(),
            'file' => fake()->word(),
            'user_id' => User::factory(),
            'document_type_id' => DocumentType::factory(),
            'commission_id' => Commission::factory(),
        ];
    }
}
