<?php

namespace Database\Seeders;

use App\Models\Regime;
use Illuminate\Database\Seeder;

class RegimeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Regime::insert([
            'name' => 'Territorial – Municipio de Barrancabermeja',
            'description' => 'Aplica a servidores públicos de la Alcaldía de Barrancabermeja, sus secretarías y entes descentralizados sin régimen especial.',
            'legal_basis' => 'Ley 909 de 2004 y Decreto 785 de 2005. Escalas salariales fijadas mediante Acuerdos Municipales del Concejo de Barrancabermeja.',
        ]);
    }
}
