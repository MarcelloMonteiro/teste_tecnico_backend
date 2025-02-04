<?php

namespace App\Http\Controllers;

use App\Models\Cidade;
use Illuminate\Http\Request;

class CidadeController extends Controller {

    public function index(Request $request) {
        
        $nome = $request->query('nome');

        $cidades = Cidade::when($nome, function ($query, $nome) {
            $query->where('nome', 'LIKE', "%{$nome}%");
        })->orderBy('nome')->get();

        return response()->json($cidades);
    }
}
