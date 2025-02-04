<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Paciente;

class PacienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        Paciente::create(['nome' => 'Carlos Silva', 'cpf' => '123.456.789-00', 'celular' => '11987654321']);
        Paciente::create(['nome' => 'Ana Souza', 'cpf' => '987.654.321-00', 'celular' => '11912345678']);
    }
}
