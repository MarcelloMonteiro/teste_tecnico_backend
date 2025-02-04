<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Cidade;

class CidadeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        Cidade::create(['nome' => 'São Paulo', 'estado' => 'SP']);
        Cidade::create(['nome' => 'Rio de Janeiro', 'estado' => 'RJ']);
    }
}
