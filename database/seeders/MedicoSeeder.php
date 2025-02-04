<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Medico;

class MedicoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        Medico::create(['nome' => 'Dr. João', 'especialidade' => 'Cardiologista', 'cidade_id' => 1]);
        Medico::create(['nome' => 'Dra. Maria', 'especialidade' => 'Pediatra', 'cidade_id' => 2]);
    }
}
