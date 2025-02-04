<?php

namespace App\Http\Controllers;

use App\Models\Medico;
use Illuminate\Http\Request;

class MedicoController extends Controller {
    
    public function index() {
        return response()->json(Medico::with('cidade')->get());
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
