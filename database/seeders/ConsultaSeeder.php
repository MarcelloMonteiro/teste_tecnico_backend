<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Consulta;

class ConsultaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        Consulta::create(['medico_id' => 1, 'paciente_id' => 1, 'data' => now()->addDays(2)]);
        Consulta::create(['medico_id' => 2, 'paciente_id' => 2, 'data' => now()->addDays(5)]);
    }
}
