<?php

namespace Database\Seeders;

use App\Models\RegimeLevel;
use Illuminate\Database\Seeder;

class RegimeLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RegimeLevel::insert(
            [
                ['name' => 'Directivo',   'code' => 'DIR', 'regime_id' => 1],
                ['name' => 'Asesor',      'code' => 'ASE', 'regime_id' => 1],
                ['name' => 'Profesional', 'code' => 'PRO', 'regime_id' => 1],
                ['name' => 'Técnico',     'code' => 'TEC', 'regime_id' => 1],
                ['name' => 'Asistencial', 'code' => 'ASI', 'regime_id' => 1],
            ]
        );
    }
}
