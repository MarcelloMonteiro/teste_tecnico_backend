<?php

namespace App\Http\Controllers;

use App\Models\Medico;
use Illuminate\Http\Request;

class MedicoController extends Controller {
    
    public function index(Request $request) {

        $nome = $request->query('nome');

        $medicos = Medico::with('cidade')
            ->when($nome, function ($query, $nome) {
                $query->whereRaw("REPLACE(REPLACE(nome, 'Dr. ', ''), 'Dra. ', '') LIKE ?", ["%{$nome}%"]);
            })
            ->orderBy('nome')
            ->get();

        return response()->json($medicos);
    }

    public function getMedicosByCidade(Request $request, $id_cidade) {

        $nome = $request->query('nome');

        $medicos = Medico::where('cidade_id', $id_cidade)
            ->when($nome, function ($query, $nome) {
                $query->whereRaw("REPLACE(REPLACE(nome, 'Dr. ', ''), 'Dra. ', '') LIKE ?", ["%{$nome}%"]);
            })
            ->orderBy('nome')
            ->get();

        return response()->json($medicos);
    }

    public function store(Request $request) {

        $medico = Medico::create($request->validate([
            'nome' => 'required|string|max:255',
            'especialidade' => 'required|string|max:255',
            'cidade_id' => 'required|exists:cidades,id',
        ]));

        return response()->json($medico, 201);
    }

}
